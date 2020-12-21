<?php

namespace App\Http\Controllers\Backend\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Merchant\RechargeRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class ManagementMoneyController extends Controller
{
    //Quản lý nạp tiền

    public function getRecharge()
    {
        return view('Backend.Merchant.Recharge');
    }

    public function postRecharge(request $request)
    {
        $query = str_replace(',', '', $request->get('query'));
        $money =  User::find(Auth::user()->id);
        $money->money_bonus += str_replace(',', '', $request->money);
        $money->save();
        return redirect()->back()->with('success' ,'Recharge success');
    }

    //Quản lý rút tiên

}
