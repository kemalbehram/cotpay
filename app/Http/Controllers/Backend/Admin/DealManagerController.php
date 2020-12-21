<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Order\Order;
use App\User;
use Illuminate\Support\Facades\DB;

class DealManagerController extends Controller
{
    public function getlistThan(){
      
        $than_deal = DB::table('orders')
                            ->join('users', 'users.name_user', '=', 'orders.name_user')
                            ->where('money_value','>',10000000)
                            ->whereIn('level', [1, 2])
                            ->orderBy('sell_buy')
                            ->get();
        return view('Backend.Admin.DealManager.ListDealThan10t',compact('than_deal'));
    }

    public function getlistUnder(){
        $under_deal = DB::table('orders')
                    ->join('users', 'users.name_user', '=', 'orders.name_user')
                    ->where('money_value','<=',10000000)
                    ->whereIn('level', [1, 2])
                    ->orderBy('sell_buy')
                    ->get();

        return view('Backend.Admin.DealManager.ListDealUnder10t',compact('under_deal'));
    }

    public function getlistDetail($id){
        $order = Order::find($id);
        return view('Backend.Admin.DealManager.DetailDeal',compact('order'));
    }

    public function listBusiness(){
        $business = DB::table('orders')
                    ->join('users', 'users.name_user', '=', 'orders.name_user')
                    ->where('level',3)
                    ->orderBy('sell_buy')
                    ->get();
        return view('Backend.Admin.DealManager.ListBusiness',compact('business'));
    }
}

