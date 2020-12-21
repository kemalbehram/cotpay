<?php

namespace App\Http\Requests\Backend\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LoginAccountAdminRequest extends FormRequest
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
            'phone'     =>  'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|size:10',
            'password'  =>  'required|min:8|max:30',
        ];
    }
}
