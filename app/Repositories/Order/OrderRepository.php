<?php
/**
 * Created by PhpStorm.
 * User: molap
 * Date: 3/18/2020
 * Time: 11:17 AM
 */

namespace App\Repositories\Order;

use App\Repositories\Order\OrderRepositoryInterface;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

use App\Models\Backend\Order\Order;

class OrderRepository implements OrderRepositoryInterface
{
	// private $orders;

 //    public function __construct(Order $orders)
 //    {
 //        parent::__construct($orders);
 //        $this->orders = $orders;
 //    }

    public function countOrderByStatus($status, $sellBuy)
    {
        $month = date('m');
        $reverse = ($sellBuy == 1) ? 2 : 1;

        $count = count(Order::where(function ($query) use ($sellBuy, $month, $status) {
            $query->where('sell_buy', $sellBuy)->where('user_id', Auth::user()->id)->whereMonth('created_at', $month)->where('status', $status);
        })->orWhere(function ($query) use ($reverse, $month, $status) {
            $query->where('sell_buy', $reverse)->where('user_id_receiver', Auth::user()->id)->whereMonth('created_at', $month)->where('status', $status);
        })->get());

        return $count;
    }

    public function getListOrder($sellBuy)
    {
        $month = date('m');
        $reverse = ($sellBuy == 1) ? 2 : 1;

        $orders = Order::where(function ($query) use ($sellBuy, $month) {
            $query->whereMonth('created_at', $month)->where('sell_buy', $sellBuy)->where('user_id', Auth::user()->id);
        })->orWhere(function ($query) use ($reverse, $month) {
            $query->whereMonth('created_at', $month)->where('sell_buy', $reverse)->where('user_id_receiver', Auth::user()->id);
        })->orderBy('id','desc')->get();

        return $orders;
    }

    public function getAllOrderByDate($start, $end, $sellBuy)
    {
        $reverse = ($sellBuy == 1) ? 2 : 1;

        $orders = Order::where(function ($query) use ($sellBuy, $start, $end) {
            $query->where('sell_buy', $sellBuy)->where('user_id', Auth::user()->id)->whereDate('created_at','>=',$start)->whereDate('created_at','<=',$end);
        })->orWhere(function ($query) use ($reverse, $start, $end) {
            $query->where('sell_buy', $reverse)->where('user_id_receiver', Auth::user()->id)->whereDate('created_at','>=',$start)->whereDate('created_at','<=',$end);
        })->orderBy('id','desc')->get();

        return $orders;
    }

    public function countOrderByStatusAndDate($sellBuy, $status, $start, $end)
    {
        $reverse = ($sellBuy == 1) ? 2 : 1;

        $count = count(Order::where(function ($query) use ($sellBuy, $start, $end, $status) {
            $query->where('sell_buy', $sellBuy)->where('user_id', Auth::user()->id)->whereDate('created_at','>=',$start)->whereDate('created_at','<=',$end)->where('status', $status);
        })->orWhere(function ($query) use ($reverse, $start, $end, $status) {
            $query->where('sell_buy', $reverse)->where('user_id_receiver', Auth::user()->id)->whereDate('created_at','>=',$start)->whereDate('created_at','<=',$end)->where('status', $status);
        })->orderBy('id','desc')->get());

        return $count;
    }

}