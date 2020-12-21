<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\Backend\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Backend\ForgotPassworEmailRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Backend\ResetPassword;
use App\Models\Cities;

class AccountController extends Controller
{
    //---xác nhận tài khoản----
    public function getVerifyAccount(Request $request)
    {
        $code = $request->code;
        $id = $request->id;
        $user=User::where([
            'code'=>$code,
            'id'=>$id])->first();
            if(!$user)
            {
                return redirect()->back()->with('danger','Link verify false !');
            }
        $user->is_active=1;
        $user->save();
        return redirect('login')->with('success','Verify success !');
    }
    
    //---Đổi mật khẩu----
    public function getChangePassword()
    {
        return view('Backend.Pages.Change_Password');
    }

    public function postChangePassword(ChangePasswordRequest $request)
    {
        if (Hash::check($request->password_old, Auth::user()->password))
            {
                $user= User::find(Auth::user()->id);
                $user->password=bcrypt($request->password);
                $user->save();
                // Auth::user()->update([
                //     'password' => bcrypt($request->password)
                // ]);
                return redirect()->back()->with('success','Changer password success !');
            }
        else 
            {
                return redirect()->back()->with('danger','Password old false !');
            }
    }


    // quên mật khẩu
    public function postForgotPasswordUser(ForgotPassworEmailRequest $request)
    {
        // dd($request->all());
        $email=$request->email;
        $checkEmail = User::where('email',$email)->first();
       
        if(!$checkEmail)
        {
            return response()->json(['danger' => 'Email does not exist !']);
        }
        $code = bcrypt(time().$email);
        $checkEmail->code_forgot_password =$code;
        $checkEmail->time_forgot_password =Carbon::now();
        $checkEmail->save();
        $url = route('link.reset.password',['code'=>$checkEmail->code_forgot_password,'email'=>$email]);
        $data=[
            'route' => $url,
        ];

        Mail::send('Frontend.Pages.EmailForm.Email_Forgot_Password', $data, function($message) use ($email){
            $message->to($email, 'Reset Password')->subject('Reset Password Cot-pay !');
        });

        return redirect()->back()->with('success','Send mail success, pleasea check your email !');
    }


    public function resetPassword(request $request)
    {
        //dd($request->all());
        $code = $request->code;
        $email = $request->email;
        $checkEmail=User::where([
            'code_forgot_password'=>$code,
            'email'=>$email])->first();
        if(!$checkEmail)
        {
            return redirect()->back()->with('danger','Sorry the link to get the link back is incorrect !');   
        }
        $data['email'] = $email;
        $data['code'] = $code;
        return view('Frontend.Pages.Reset_Password', $data);
    }

    public function postResetPassword(ResetPassword $request)
    {
         //dd($request->all());
         if($request->password)
         {
             $code = $request->code;
             $email = $request->email;
             $checkEmail=User::where([
                 'code_forgot_password'=>$code,
                 'email'=>$email
             ])->first(); 
         }
       
         if(!$checkEmail)
         {
            return redirect()->back()->with('danger','Sorry the link to get the link back is incorrect !'); 
         }

     
         $checkEmail->password=bcrypt($request->password);
 
         $checkEmail->save();

         return redirect('login')->with('success','Password successfully recovered !');
    }



    //thông tin tài khoản
    public function getInfoAccount($id)
    {
        $data['user'] = User::find($id);
        $user = User::find($id);
        $data['city_ward'] = Cities::where('code', $user->ward)->first();
        $data['city_district'] = Cities::where('code', $user->district)->first();
        $data['city_city'] = Cities::where('code', $user->city)->first();
        return view('Backend.Pages.Info_Account', $data);
    }

    public function postInfoAccount(request $request ,$id)
    {
     // dd($request->all());
       $user = User::find($id);
       
       if($user->level == 1)
       { 
           $user->level = 1;
       }
       elseif($user->level == 2)
       {
            $user->level = 2;
       }
       else
       {
            $user->level = 3;
       }
       $user->name = $request->name;
       $user->email = $request->email;
       $user->address = $request->address;
       $user->city = $request->city;
       $user->district = $request->district;
       $user->ward = $request->ward;
        if($request->phone)
        {
            if($user->level == 1)
            {
                $user->phone = $request->phone;
                $user->code_user = $request->phone;
            }
            else
            {
                $user->phone = $request->phone; 
            }
        }
        if($request->user_name)
        {
            $user->user_name = $request->user_name;
        }
        if($request->code_tax)
        {
            $user->code_tax = $request->code_tax;
        }
        $user->save();
        return redirect()->back()->with('success', 'Profile change successful')->withInput();
       
    }


}
