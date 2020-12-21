<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Order\Order;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\Admin\Bonus;
use Illuminate\Support\Facades\Mail;

class PurchaseProposalController extends Controller
{
    //xác nhận đơn hàng
    public function verifyOrder($id)
    {
        
        $bonus = Bonus::find(1);
        $order = Order::find($id);
        if($order->sell_buy == 1)
        {
            $user = User::find($order->user_id_receiver);
            if($user->money_bonus >= $order->money_value)
            {
                if($order->collection == 1)
                {
                    $user->money_bonus = $user->money_bonus - $order->money_value;
                    $user->save();
                    $bonus->bonus += $order->money_value;
                    $bonus->save(); 
                }else
                {
                    $user->money_bonus = $user->money_bonus - ($order->money_value + $order->ship_fee);
                    $user->save();
                    $bonus->bonus += ($order->money_value + $order->ship_fee);
                    $bonus->save(); 
                }
            }else
            {
                return redirect()->back()->with('danger', 'Bạn không đủ tiền để thanh toán đơn hàng!')->withInput();
            }
        }
        elseif($order->sell_buy == 2)
        {
            $user = User::find($order->user_id);
            $user_receiver = User::find($order->user_id_receiver);
            if($user->money_bonus > $order->money_value)
            {
                if($order->collection == 1)
                {
                    $user->money_bonus = $user->money_bonus - $order->money_value;
                    $user->save();
                   if ($user_receiver->money_bonus > ($order->ship_fee + $order->cotpay_fee) * 2) {
                        $user_receiver->money_bonus = $user_receiver->money_bonus - $order->ship_fee - $order->cotpay_fee;
                        $user_receiver->save();
                   } else {
                       return redirect()->back()->with('danger', 'Bạn không đủ tiền để thanh toán đơn hàng!')->withInput();
                   }
                   
                    $bonus->bonus += $order->money_value + $order->ship_fee + $order->cotpay_fee;
                    $bonus->save(); 

                }else
                {
                    $user->money_bonus = $user->money_bonus - $order->money_value;
                    $user->save();

                     if ($user_receiver->money_bonus > $order->cotpay_fee * 2) {
                        $user_receiver->money_bonus = $user_receiver->money_bonus- $order->cotpay_fee;
                        $user_receiver->save();
                   } else {
                       return redirect()->back()->with('danger', 'Bạn không đủ tiền để thanh toán đơn hàng!')->withInput();
                   }

                    $bonus->bonus += $order->money_value + $order->cotpay_fee;
                    $bonus->save(); 
                }
            }
            else
            {
                return redirect()->back()->with('danger', 'Người mua không đủ tiền để thanh toán đơn hàng!')->withInput();
            }
        }
        $order->status = 2;
        $order->save();
        return redirect()->back()->with('success', 'Xác nhận thành công')->withInput();
    }

    //từ chối đơn hàng
    public function refuseOrder($id)
    {
        $order = Order::find($id);
        $order->status = 10;
        $order->save();

        $bonus = Bonus::find(1);
        $sender = User::find($order->user_id);
        $email = $sender->email;

        if ($order->sell_buy == 1) {
            if ($order->collection == 1) {
                $sender->money_bonus += $order->ship_fee + $order->cotpay_fee;
                $bonus->bonus -= ($order->ship_fee + $order->cotpay_fee);        
            } else {
                $sender->money_bonus += $order->cotpay_fee;
                $bonus->bonus -= $order->cotpay_fee;
            }
            
        } else {
            if ($order->collection == 2) {
                $sender->money_bonus += $order->ship_fee;
                $bonus->bonus -= $order->ship_fee;
            }
            
        }

        $sender->save();
        $bonus->save();
        

        $data=[
            'code_deal' => $order->code_deal,
            'money_value' => number_format($order->money_values),
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

        Mail::send('Backend.Pages.EmailForm.Email_Refuse_Order', $data, function($message) use ($email){
            $message->to($email, 'Từ chối đơn hàng')->subject('Từ chối đơn hàng !');
        });

        return redirect()->back()->with('success', 'Đã từ chối đơn hàng '.$id)->withInput();
    }
}