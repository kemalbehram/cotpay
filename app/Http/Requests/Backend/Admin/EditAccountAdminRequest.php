<?php

namespace App\Http\Requests\Backend\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EditAccountAdminRequest extends FormRequest
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
            'name'      =>  'required',
            'email'     =>  'required|email|unique:users,email,'.$this->id,'id',
            'phone'     =>  'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|size:10|unique:users,phone,'.$this->id,'id',
            'address'   =>  'required|max:180',
            'city'      =>  'required',
            'district'  =>  'required',
            'ward'      =>  'required',
            'roles'      =>  'required'
        ];
    }
}
