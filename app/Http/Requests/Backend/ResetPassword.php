<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ResetPassword extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' =>'required|min:8|max:30',
            'password_confirmation'=>'required|same:password'
        ];
    }
    // public function messages()
    // {
    //     return [
    //         'password.required'=>'Pleasea enter password !',
    //         'password_confirmation.same' => 'Password entered does not match !',
    //         'password_confirmation.required' => 'Please enter password confirmation !',
    //         'password.max'=>'Password from 8 to 30 characters !',
    //         'password.min'=>'Password from 8 to 30 characters !',
    //     ];
    // }
}
