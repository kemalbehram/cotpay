<?php
namespace App\Repositories;

use App\Http\Requests\Backend\User\ForgotPassworEmailRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function list()
    {
        return $this->model->all();
    }

    public function show($id)
    {
        return $this->model->find($id);
    }

    public function store($input)
    {
        return $this->model->create($input);

    }

    public function update($id ,$input)
    {
        $result = $this->model->find($id);
        if ($result) {
            $result->update($input);
            return $result;
        }
        return false;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }


    //----------forgot password and reset password------------------

    public function getForgotPassword($linkReset,$mailTemplate,$request)
    {
        $email = $request->email;
        $checkEmail = $this->model->where('email',$email)->first();
        if (!$checkEmail) {
            return response()->json(['danger' => 'Email không tồn tại !']);
        }
        $code = bcrypt(time().$email);
        $checkEmail->code =$code;
        $checkEmail->time_code = Carbon::now();
        $checkEmail->save();
        $url = route($linkReset,['code'=>$checkEmail->code,'email'=>$email]);
        $data=[
            'route' => $url,
        ] ;
        Mail::send($mailTemplate, $data, function($message) use ($email){
            $message->to($email, 'Reset Password')->subject('Reset Password Cot-Pay !');
        });
    }

    public function getResetPassword()
    {
        $code = request()->code;
        $email = request()->email;
        $checkEmail = $this->model->where([
            'code' => $code,
            'email' => $email])->first();
        if (!$checkEmail) {
            return redirect()->back()->with('danger', 'Sorry the link to get the link back is incorrect !');
        }
    }

    public function postResetPassword($request)
    {
        $code = $request->code;
        $email = $request->email;
        $checkEmail = $this->model->where([
            'code' => $code,
            'email' => $email])->first();
        if (!$checkEmail) {
            return redirect()->back()->with('danger', 'Sorry the link to get the link back is incorrect !');
        }

        $checkEmail->password = bcrypt(request()->password);
        $checkEmail->save();
    }

    //----------end forgot password and reset password------------------



    //-----verify account --------------------

    public function sendMailVerifyAccount($id, $route, $template)
    {
        $datas = [
            'name' => \request()->name,
            'route' =>  route($route, ['id' => $id])
        ];

        $email = request()->email;
        Mail::send($template, $datas, function($message) use ($email){
            $message->to($email, 'Verify your COT PAY account')->subject('Verify your COT PAY account');
        });


    }
    //-----end verify account --------------------
    
}
