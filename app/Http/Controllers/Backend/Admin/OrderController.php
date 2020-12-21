<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Admin\Bonus;
use App\Models\Backend\Order\Order;

class OrderController extends Controller
{
    //trang chủ
    public function getOrder() {
        $month = date('m');
        // whereIn('status', [2,8])->
        $data['orders'] = Order::whereMonth('created_at', $month)->orderBy('id','desc')->get();
        
        return view('Backend.Admin.Order.Order', $data);
    }

    // public function changeStatus($id, $status)
    // {
    //     $order = Order::find($id);
    //     $order->status = $status;
    //     $order->save();
    // }
    
    // xử lý nút bom hàng
    public function bomOrder($id)
    {
        $order = Order::find($id);
        $order->status = 6;
        $order->save();

        return redirect()->back()->with('success', 'Đã chuyển trạng thái bom hàng ')->withInput();
    }

    public function receiveOrder($id)
    {
        $order = Order::find($id);
        $order->status = 3;
        $order->save();

        return redirect()->back()->with('success', 'Khách nhận đơn ')->withInput();
    }

    public function returnOrder($id)
    {
        $order = Order::find($id);
        $order->status = 5;
        $order->save();

        return redirect()->back()->with('success', 'Khách nhận đơn ')->withInput();
    }

    public function deliveryOrder($id)
    {
        $order = Order::find($id);
        $order->status = 8;
        $order->save();

        return redirect()->back()->with('success', 'Đã nhận hàng để vận chuyển ')->withInput();
    }
}
