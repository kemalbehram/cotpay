<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\Backend\Admin\Admin;
use App\Http\Requests\Backend\{ForgotPassworEmailRequest, ResetPassword};
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    // quên mật khẩu
    public function getFogotPassword()
    {
        return view('Backend.Admin.Forgot_Password');
    }

    public function postFogotPassword(ForgotPassworEmailRequest $request)
    {
        
        $email=$request->email;
        $check_email = Admin::where('email',$email)->first();
        if(!$check_email)
        {
            return redirect()->back()->with('danger', 'Email does not exist !')->withInput();
        }
        $code = bcrypt(time().$email);
        $check_email->code =$code;
        $check_email->time_code =Carbon::now();
        $check_email->save();
        $url = route('link.reset.password.admin',['code'=>$check_email->code,'email'=>$email]);
        $data=[
            'route' => $url,
        ];

        Mail::send('Backend.Admin.Email_Forgot_Password', $data, function($message) use ($email){
            $message->to($email, 'Reset Password')->subject('Reset Password Cot-pay !');
        });

        return redirect()->back()->with('success','Send mail success, pleasea check your email !');
    }



    public function resetPasswordAdmin(request $request)
    {
        //dd($request->all());
        $code = $request->code;
        $email = $request->email;
        $check_email=Admin::where([
            'code'=>$code,
            'email'=>$email])->first();
        if(!$check_email)
        {
            return redirect()->back()->with('danger','Sorry the link to get the link back is incorrect !');   
        }
        // $data['email'] = $email;
        // $data['code'] = $code;
        return view('Backend.Admin.Reset_Password');
    }


    public function postResetPasswordAdmin(ResetPassword $request)
    {
       // dd($request->all());
        if($request->password)
        {
            $code = $request->code;
            $email = $request->email;
            $check_email=Admin::where([
                'code'=>$code,
                'email'=>$email
            ])->first(); 
        }
      
        if(!$check_email)
        {
           return redirect()->back()->with('danger','Sorry the link to get the link back is incorrect !'); 
        }

    
        $check_email->password=bcrypt($request->password);
        $code = bcrypt(str::random(9));
        $check_email->code =$code;
        $check_email->save();

        return redirect('login-admin')->with('success','Password successfully recovered !');
    }

}
