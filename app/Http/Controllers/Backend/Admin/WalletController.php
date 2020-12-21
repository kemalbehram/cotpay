<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;

class WalletController extends Controller
{
    //Ví wallet
    public function getWallet() {
        $data['Wallet'] = Wallet::all();
        return view('Backend.Admin.Wallet.WalletInfo', $data);
    }
    public function getLockWallet($id)
   {
      $wallet = Wallet::find($id);
      $wallet->status = 2;
      $wallet->save();
      return redirect()->back()->with('success' ,'Lock wallet success')->withInput();
   }

    //mở khóa tài khoản người dùng
    public function getUnlockWallet($id)
    {
        $wallet = Wallet::find($id);
        $wallet->status = 1;
        $wallet->save();
        return redirect()->back()->with('success' ,'Unlock wallet success')->withInput();
    }


}
