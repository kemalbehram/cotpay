<?php

namespace App\Http\Requests\Backend\Customer;

use Illuminate\Foundation\Http\FormRequest;

class SellRequest extends FormRequest
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
            'code_user' => 'required',
            'phone_receiver' => 'required',
            'name_receiver' => 'required',
            'name_user' => 'required',
            'address_receiver' => 'required',
            'city' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'money_value' => 'required',
            'cotpay_fee' => 'required',
            'content' => 'required',
            'long' => 'required|numeric',
            'qty' => 'required|numeric',
            'wide' => 'required|numeric',
            'height' => 'required|numeric',
            'weight' => 'required',
            'ship_fee' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'code_user.required' => 'mã không được để trống',
            'phone_receiver.required' => 'required',

        ];
    }
}
