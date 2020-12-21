<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Order\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Cities;
use App\User;
use App\Models\Backend\Admin\Bonus;

use Illuminate\Support\Facades\Mail;

class StatusController extends Controller
{   
    /* 
    ------------------------------------------------
    --------các trạng thái của người gửi------------
    ------------------------------------------------
    1-Yêu cầu
    2-Cho lấy hàng
    3-Đã nhận
    4-Giao dịch hủy
    5-Nhận lại hàng
    6-Bom hàng
    7-Đã nhận lại hàng trả
    8-dang van chuyen
    10-Đã từ chối
    99-Thanh toán thành công
    ------------------------------------------------
     */

    //lấy danh sách đơn hàng theo trạng thái
    public function getOrderByStatus(Request $Request)
    {
        $sell_buy = $Request->sell_buy;
        $status = $Request->status;
        $reverse = ($sell_buy == 1) ? 2 : 1;
        
        if (is_null($Request->start) || is_null($Request->end)) {
            $month = date('m');
            $orders = Order::where(function ($query) use ($sell_buy, $month, $status) {
                $query->where('sell_buy', $sell_buy)->where('user_id', Auth::user()->id)->whereMonth('created_at', $month)->where('status', $status);
            })->orWhere(function ($query) use ($reverse, $month, $status) {
                $query->where('sell_buy', $reverse)->where('user_id_receiver', Auth::user()->id)->whereMonth('created_at', $month)->where('status', $status);
            })->get();
        } else {
            $start = $Request->start;
            $end = $Request->end;
            
            $orders = Order::where(function ($query) use ($sell_buy, $start, $end, $status) {
                $query->where('sell_buy', $sell_buy)->where('user_id', Auth::user()->id)->whereDate('created_at','>=',$start)->whereDate('created_at','<=',$end)->where('status', $status);
            })->orWhere(function ($query) use ($reverse, $start, $end, $status) {
                $query->where('sell_buy', $reverse)->where('user_id_receiver', Auth::user()->id)->whereDate('created_at','>=',$start)->whereDate('created_at','<=',$end)->where('status', $status);
            })->orderBy('id','desc')->get();
        }
        return response()->json([
            'orders' => $orders,
        ], 200);
    }

    // xử lý nút hủy đơn
    public function canceledOrder($id)
    {
        $order = Order::find($id);
        $order->status = 4;
        $order->save();

        $bonus = Bonus::find(1);
        $user = User::find($order->user_id);

        if ($order->sell_buy == 1) {
            if ($order->collection == 1) {
                $user->money_bonus += $order->ship_fee + $order->cotpay_fee;
                $bonus->bonus -= ($order->ship_fee + $order->cotpay_fee);        
            } else {
                $user->money_bonus += $order->cotpay_fee;
                $bonus->bonus -= $order->cotpay_fee;
            }
        } else {
            if ($order->collection == 2) {
                $user->money_bonus += $order->ship_fee;
                $bonus->bonus -= $order->ship_fee;
            }
        }

        $bonus->save();
        $user->save();
        
        return redirect()->back()->with('success', 'Đã hủy đơn hàng ')->withInput();
    }

    // xử lý nút yêu cầu thanh toán
    public function requestPay($id)
    {
        $order = Order::find($id);
        $sender = User::find($order->user_id);
        $email = $sender->email;

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
        ];
        
        Mail::send('Backend.Pages.EmailForm.Email_Request_Pay', $data, function($message) use ($email){
            $message->to($email, 'Yêu cầu thanh toán đơn hàng')->subject('Yêu cầu thanh toán đơn hàng !');
        });

        return redirect()->back()->with('success', 'Đã gửi Mail yêu cầu thanh toán ')->withInput();
    }

    // xử lý nút đồng ý nhận lại đơn hàng
    public function agreeReReceive($id)
    {
        // Đổi trạng thái
        $order = Order::find($id);
        $order->status = 7;
        $order->save();
        // Xử lý dòng tiền
        $bonus = Bonus::find(1);
        $user = User::find($order->user_id);
        $user_receiver = User::find($order->user_id_receiver);
        
        if ($order->sell_buy == 1) {
            if($order->collection == 1)
            {
                $user->money_bonus += $order->cotpay_fee;
                $user_receiver->money_bonus += $order->money_value;

                $bonus->bonus -= ($order->money_value + $order->cotpay_fee);
            }else
            {
                $user_receiver->money_bonus += ($order->money_value + $order->ship_fee);

                $user->money_bonus -= $order->ship_fee;
                $user->money_bonus += $order->cotpay_fee;

                $bonus->bonus -= ($order->money_value + $order->cotpay_fee);
                
            }
        } else {
            if($order->collection == 1)
            {
                $user_receiver->money_bonus += $order->cotpay_fee;
                $user->money_bonus += $order->money_value;

                $bonus->bonus -= ($order->money_value + $order->cotpay_fee);
            }else
            {
                $user->money_bonus += ($order->money_value + $order->ship_fee);

                $user_receiver->money_bonus += $order->cotpay_fee; 
                $user_receiver->money_bonus -= $order->ship_fee;

                $bonus->bonus -= ($order->money_value + $order->cotpay_fee);
            }
        }

        // tính tỉ lệ hoàn đơn
        $order_returned = count(Order::where(function ($query) {
            $query->where('sell_buy', 1)->where('user_id', Auth::user()->id)->where('status', 7);
        })->orWhere(function ($query) {
            $query->where('sell_buy', 2)->where('user_id_receiver', Auth::user()->id)->where('status', 7);
        })->get());

        $order_confirmed = count(Order::where(function ($query) {
            $query->where('sell_buy', 1)->where('user_id', Auth::user()->id)->whereNotIn('status', [1,7]);
        })->orWhere(function ($query) {
            $query->where('sell_buy', 2)->where('user_id_receiver', Auth::user()->id)->whereNotIn('status', [1,7]);
        })->get());

        $user->percent_returned = ($order_returned == 0) ? 0 : ($order_returned / $order_returned) ;
        //____________________

        $user->save();
        $user_receiver->save();
        $bonus->save(); 

        return redirect()->back()->with('success', 'Đã đồng ý nhận lại đơn hàng ')->withInput();
    }

    // xử lý nút thanh toán
    public function paymentOrder($id)
    {
        $order = Order::find($id);
        $order->status = 99;
        $order->save();

        // Gửi tiền về trừ tiền trong ví
        $bonus = Bonus::find(1);
        $user = User::find($order->user_id);
        $user_receiver = User::find($order->user_id_receiver);

        if($order->sell_buy == 1)
        {
            $user->money_bonus += $order->money_value;
            $bonus->bonus -= $order->money_value;
        }
        elseif($order->sell_buy == 2)
        {
            $bonus->bonus -= $order->money_value;
            $user_receiver->money_bonus += $order->money_value;
        }

        $user->save();
        $bonus->save();
        $user_receiver->save();

        return redirect()->route('get.rating',$id)->with('success', 'Đơn hàng đã được thanh toán ')->withInput();
    }

    // xử lý nút đề nghị hoàn đơn
    public function requestReturnOrder($id)
    {
        $order = Order::find($id);
        $sender = User::find($order->user_id);
        $email = $sender->email;

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
        ] ;

        Mail::send('Backend.Pages.EmailForm.Email_Request_Return_Order', $data, function($message) use ($email){
            $message->to($email, 'Đề nghị hoàn đơn')->subject('Đề nghị hoàn đơn !');
        });

        return redirect()->back()->with('success', 'Đã đề nghị hoàn đơn ')->withInput();
    }

    // xử lý nút đề nghị hoàn tiền
    public function requestReturnMoney($id)
    {
        $order = Order::find($id);
        $sender = User::find($order->user_id);
        $email = $sender->email;

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
        ] ;

        Mail::send('Backend.Pages.EmailForm.Email_Refuse_Money', $data, function($message) use ($email){
            $message->to($email, 'Yêu cầu hoàn tiền')->subject('Yêu cầu hoàn tiền !');
        });

        return redirect()->back()->with('success', 'Đã gửi Mail yêu cầu thanh toán ')->withInput();
    }

}
