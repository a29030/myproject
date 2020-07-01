<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class changepassword extends FormRequest
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
            'password'=>'min:5|max:15|confirmed',
            'password_confirmation' =>'required',
            'newpassword'=>'min:5|max:15',
        ];
    }

    public function messages()
    {
        return [
            'password.min'=>'Mật khẩu không được ít hơn 5 kí tự và nhiều hơn 15 kí tự',
            'password.max'=>'Mật khẩu không được ít hơn 5 kí tự và nhiều hơn 15 kí tự',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp',
            'newpassword.min'=>'Mật khẩu không được ít hơn 5 kí tự và nhiều hơn 15 kí tự',
            'newpassword.max'=>'Mật khẩu không được ít hơn 5 kí tự và nhiều hơn 15 kí tự',

        ];
    }
}
