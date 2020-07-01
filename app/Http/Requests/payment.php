<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class payment extends FormRequest
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
            'fullname' => 'required|min:3|max:50',
            'email' => 'required|min:11|max:50|email',
            'phone' => 'required|min:10|max:10',
            'address' => 'required|min:5|max:50'
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => "Vui lòng điền họ tên",
            'fullname.min' => 'Họ tên không được ít hơn 3 và nhiều hơn 50 kí tự',
            'fullname.max' => 'Họ tên không được ít hơn 3 và nhiều hơn 50 kí tự',
            'email.required' => "Vui lòng điền Email",
            'email.min' => 'Email không được dưới 11 kí tự và quá 50 kí tự',
            'email.max' => 'Email không được dưới 11 kí tự và quá 50 kí tự',
            'email.email' => 'Email không đúng định dạng',
            'phone.required' => "Số điện thoại không được để trống",
            'phone.min' => 'Số điện thoại chỉ được 10 kí tự',
            'phone.max' => 'Số điện thoại chỉ được 10 kí tự',
            'address.required' => "Địa chỉ không được để trống",
            'address.min' => 'Địa chỉ không được ít hơn 5 kí tự và vượt 50 kí tự',
            'address.max' => 'Địa chỉ không được ít hơn 5 kí tự và vượt 50 kí tự'
        ];
    }
}
