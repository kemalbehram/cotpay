<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\LoginShopRequest;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function getLogin()
    {
        return view('Frontend.Pages.Login');
    }

    public function postLogin(LoginShopRequest $request)
    {
       //dd($request->all());
        $phone = $request->phone;
        $password = $request->password;
        if (Auth::attempt(['phone' => $phone, 'password' => $password], $request->remember)) 
        {
            // dd( Auth::user()->is_active == 1 && Auth::user()->lock == 1);

            if (Auth::user()->is_active == 1 && Auth::user()->lock == 1) {
                if (Auth::user()->level == 1) {
                    return redirect(route('customer.index'));
                } else if (Auth::user()->level == 2) {
                    return redirect(route('merchant.index'));
                } else if (Auth::user()->level == 3) {
                    return redirect(route('business.index'));
                }
            } else {
                Auth::logout();
                return redirect(route('get.login'))->with('danger', 'Tài khoản của bạn chưa được kích hoạt hoặc đang bị khóa!');
            }
        } 
        else 
        {
            return redirect()->back()->with('danger', 'Số điện thoại hoặc mật khẩu sai!');
        }
    }

    // đắng xuất
    public function getLogOut()
    {
        Auth::logout();
        return redirect('/');
    }

}
