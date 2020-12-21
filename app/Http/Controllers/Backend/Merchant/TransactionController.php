<?php

namespace App\Http\Controllers\Backend\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Wallet, Cities, ShippingUnit};
use App\Models\Backend\Admin\Bonus;
use App\User;
use Session;
use App\Models\Backend\Order\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Backend\CreateOrderRequest;

class TransactionController extends Controller
{
    //tạo giao dịch bán
    public function getMerchantSell()
    {
        $data['wallets'] = Wallet::where('status',1)->get();
        $data['shipping_unit'] = ShippingUnit::where('status',1)->get();
        return view('Backend.Merchant.Create-Sell', $data);
    }
    public function postMerchantSell(CreateOrderRequest $request)
    {
        $user_id_receiver = User::where('code_user',$request->code_user)->first();

        $order = new Order;
        $order->code_deal ='1'.mt_rand(100000000000,999999999999);
        $order->user_id = Auth::user()->id;
        $order->user_id_receiver = $user_id_receiver->id;
        $order->sell_buy = 1;
        $order->money_value = str_replace(',', '', $request->money_value);
        $order->cotpay_fee = str_replace(',', '', $request->cotpay_fee);
        $order->content = $request->content;
        $order->wallet_id = $request->wallet;
        $order->name_receiver = $request->name_receiver;
        $order->name_user = $request->name_user;
        $order->phone_receiver = $request->phone_receiver;
        $order->address_receiver = $request->address_receiver;
        $order->city = $request->city;
        $order->district = $request->district;
        $order->ward = $request->ward;
        $order->shipping_unit = $request->shipping_unit;
        $order->status = 1;
        $order->note = $request->note;
        $user = User::find(Auth::user()->id);
        $order->name_sender = $user->name;
        $address_sender = $user->address;
        $ward_sender = Cities::where('code', $user->ward)->first()['name'];
        $district_sender = Cities::where('code', $user->district)->first()['name'];
        $city_sender = Cities::where('code', $user->city)->first()['name'];

        if($request->shipping_unit == 6)
        {
            $order->long = 0;
            $order->wide = 0;
            $order->height =  0;
            $order->collection = 0;
            $order->service = 0;
            $order->weight =  0;
            $order->ship_fee = 0;
        }else
        {
            $this->validate($request,
            [
                'long' => 'required|numeric',
                'wide'   =>'required|numeric',
                'height'=>'required|numeric',
                'weight'=>'required|numeric',
                'ship_fee'=>'required',
            ],
            [
                'long.required'=> 'chiều dài không được trống.',
                'wide.required'=> 'chiều rộng không được trống.',
                'height.required'=> 'chiều cao không được trống.',
                'weight.required'=> 'trọng lượng không được trống.',
                'ship_fee.required'=> 'phí ship không được trống.',
                'long.numeric'=> 'chiều dài là số.',
                'wide.numeric'=> 'chiều rộng là số.',
                'height.numeric'=> 'chiều cao là số.',
                'weight.numeric'=> 'trọng lượng là số.',
            ]);

            $order->long = $request->long;
            $order->wide = $request->wide;
            $order->height = $request->height;
            $order->collection = $request->collection;
            $order->service = $request->service;
            $order->weight = $request->weight;
            $order->ship_fee = str_replace(',', '', $request->ship_fee);
           
        }
        if($request->wallet == 5 && $request->collection == 1)
        {
            if($user->money_bonus >= ($order->ship_fee + $order->cotpay_fee) * 2)
            {
                $user->money_bonus = $user->money_bonus - ($order->ship_fee + $order->cotpay_fee);
                $user->save();
                
            }else
            {
                return redirect()->back()->with('danger', 'Số tiền trong ví của bạn không đủ để tạo đơn')->withInput();
            }
        }
        elseif($request->wallet == 5 && $request->collection == 2)
        {
            if($user->money_bonus >= ($order->ship_fee + $order->cotpay_fee) * 2)
            {
                $user->money_bonus = $user->money_bonus - $order->cotpay_fee;
                $user->save();
                
            }else
            {
                return redirect()->back()->with('danger', 'Số tiền trong ví của bạn không đủ để tạo đơn')->withInput();
            }
        }else
        {
            return redirect()->back()->with('danger', 'Ví chưa được liên kết')->withInput();
        }

        $order->save();

        $bonus = Bonus::find(1);
        if ($order->collection == 1) {
            $bonus->bonus += $order->ship_fee + $order->cotpay_fee;
        } else {
            $bonus->bonus += $order->cotpay_fee;
        }
        $bonus->save();

        
        //gủi mail cho người mua
        $email = $request->email_receiver;
        $data=[
            'code_deal' => $order->code_deal,
            'money_value' => number_format($order->money_value),
            'content' => $order->content,
            'name_receiver' => $order->name_receiver,
            'phone_receiver' => $order->phone_receiver,
            'address_receiver' => $order->address_receiver,
            'city' => $order->city,
            'district' => $order->district,
            'weight' => $order->weight,
            'ward' => $order->ward,
            'name_user' => $order->name_user,
            'name_sender' => $order->name_sender,
            'address_sender' => $address_sender,
            'city_sender' => $city_sender,
            'district_sender' => $district_sender,
            'ward_sender' => $ward_sender,
        ] ;

        Mail::send('Backend.Pages.EmailForm.Email_Create_Sell', $data, function($message) use ($email){
            $message->to($email, 'Thông tin đơn hàng')->subject('Thông tin đơn hàng !');
        });
        return redirect(route('merchant.management.sell'))->with('success', 'Gửi đề nghị xác nhận giao dịch thành công')->withInput();
    }

    //tạo đơn mua
    public function getMerchantBuy()
    {
        $data['wallets'] = Wallet::where('status',1)->get();
        $data['shipping_unit'] = ShippingUnit::where('status',1)->get();
        return view('Backend.Merchant.Create-Buy', $data);
    }
    public function postMerchantBuy(CreateOrderRequest $request)
    {
        // dd($request->all());
        $user_id_receiver = User::where('code_user',$request->code_user)->first();
        $order = new Order;
        $order->code_deal ='1'.mt_rand(100000000000,999999999999);
        $order->user_id = Auth::user()->id;
        $order->user_id_receiver = $user_id_receiver->id;
        $order->sell_buy = 2;
        $order->money_value = str_replace(',', '', $request->money_value);
        $order->cotpay_fee = str_replace(',', '', $request->cotpay_fee);
        $order->content = $request->content;
        $order->wallet_id = $request->wallet;
        $order->name_receiver = $request->name_receiver;
        $order->name_user = $request->name_user;
        $order->phone_receiver = $request->phone_receiver;
        $order->address_receiver = $request->address_receiver;
        $order->city = $request->city;
        $order->district = $request->district;
        $order->ward = $request->ward;
        $order->shipping_unit = $request->shipping_unit;
        $order->status = 1;
        $order->note = $request->note;
        
        $user = User::find(Auth::user()->id);
        $order->name_sender = $user->name;
        $address_sender = $user->address;
        $ward_sender = Cities::where('code', $user->ward)->first()['name'];
        $district_sender = Cities::where('code', $user->district)->first()['name'];
        $city_sender = Cities::where('code', $user->city)->first()['name'];

        if($request->shipping_unit == 6)
        {
            $order->long = 0;
            $order->wide = 0;
            $order->height =  0;
            $order->collection = 0;
            $order->service = 0;
            $order->weight =  0;
            $order->ship_fee = 0;
        }else
        {
            $this->validate($request,
            [
                'long' => 'required|numeric',
                'wide'   =>'required|numeric',
                'height'=>'required|numeric',
                'weight'=>'required|numeric',
                'ship_fee'=>'required',
            ],
            [
                'long.required'=> 'chiều dài không được trống.',
                'wide.required'=> 'chiều rộng không được trống.',
                'height.required'=> 'chiều cao không được trống.',
                'weight.required'=> 'trọng lượng không được trống.',
                'ship_fee.required'=> 'phí ship không được trống.',
                'long.numeric'=> 'chiều dài là số.',
                'wide.numeric'=> 'chiều rộng là số.',
                'height.numeric'=> 'chiều cao là số.',
                'weight.numeric'=> 'trọng lượng là số.',
            ]);
            $order->long = $request->long;
            $order->wide = $request->wide;
            $order->height = $request->height;
            $order->collection = $request->collection;
            $order->service = $request->service;
            $order->weight = $request->weight;
            $order->ship_fee = str_replace(',', '', $request->ship_fee);
        }
        if($request->wallet == 5 && $request->collection == 1)
        {
            if($user->money_bonus >= ($order->ship_fee + $order->cotpay_fee) * 2)
            {
                $user->money_bonus = $user->money_bonus;
                $user->save();
                
            }else
            {
                return redirect()->back()->with('danger', 'Số tiền trong ví của bạn không đủ để tạo đơn')->withInput();
            }
        }elseif($request->wallet == 5 && $request->collection == 2)
        {
            if($user->money_bonus >= $order->ship_fee * 2)
            {
                $user->money_bonus = $user->money_bonus - $order->ship_fee;
                $user->save();
            }
            else
            {
                return redirect()->back()->with('danger', 'Số tiền trong ví của bạn không đủ để tạo đơn')->withInput();
            } 
        }else
        {
            return redirect()->back()->with('danger', 'Ví chưa được liên kết')->withInput();
        }
        
        $order->save();

        if ($order->collection == 2) {
            $bonus = Bonus::find(1);
            $bonus->bonus += $order->ship_fee;
            $bonus->save();
        }

        //gủi mail cho người bán
        $email = $request->email_receiver;
        $data=[
            'code_deal' => $order->code_deal,
            'money_value' => number_format($order->money_value),
            'content' => $order->content,
            'name_receiver' => $order->name_receiver,
            'phone_receiver' => $order->phone_receiver,
            'address_receiver' => $order->address_receiver,
            'city' => $order->city,
            'district' => $order->district,
            'weight' => $order->weight,
            'ward' => $order->ward,
            'name_user' => $order->name_user,
            'name_sender' => $order->name_sender,
            'address_sender' => $address_sender,
            'city_sender' => $city_sender,
            'district_sender' => $district_sender,
            'ward_sender' => $ward_sender,
        ];

        Mail::send('Backend.Pages.EmailForm.Email_Create_Buy', $data, function($message) use ($email){
            $message->to($email, 'Thông tin đơn hàng')->subject('Thông tin đơn hàng !');
        });
        return redirect(route('merchant.management.buy'))->with('success', 'Gửi đề nghị xác nhận giao dịch thành công')->withInput();
    }

}
