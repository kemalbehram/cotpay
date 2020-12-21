<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Backend\Admin\LoginAccountAdminRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Backend\ChangePasswordRequest;
use App\Models\Backend\Admin\Admin;
use Redirect;

class LoginController extends Controller
{
    //đang nhập
    public function getLoginAdmin()
    {
        return view('Backend.Admin.Login');
    }

    public function postLoginAdmin(LoginAccountAdminRequest $request)
    {
      // dd($request->all());
       $phone = $request->phone;
       $password = $request->password;
       if (Auth::guard('admin')->attempt(['phone' => $phone, 'password' => $password], $request->remember)) 
       {
        return redirect(route('index.admin'));
       } 
       else 
       {
           return redirect()->back()->with('danger', 'Phone number or password is incorrect !')->withInput();
       }
    }

    //đăng xuất
    public function getLogoutAdmin()
    {
        Auth::guard('admin')->logout();
        return redirect(route('get.login.admin'));
    }


    //đổi password
    public function getChangePassword()
    {
        return view('Backend.Admin.Account.Change_Password');
    }
    public function postChangePassword(ChangePasswordRequest $request)
    {
        if (Hash::check($request->password_old, Auth::guard('admin')->user()->password))
            {
                $admin= Admin::find(Auth::guard('admin')->user()->id);
                $admin->password = bcrypt($request->password);
                $admin->save();
                return redirect()->back()->with('success','Changer password success !');
            }
        else 
            {
                return redirect()->back()->with('danger','Password old false !');
            }
    }
}

