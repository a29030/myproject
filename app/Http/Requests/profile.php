<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class profile extends FormRequest
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
            'phone' => 'required|min:10|max:10',
            'address' => 'required|min:5|max:100'
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Không được để trống họ tên',
            'fullname.min' => 'Họ tên không được ít hơn 3 ký tự và nhiều hơn 50 ký tự',
            'fullname.max' => 'Họ tên không được ít hơn 3 ký tự và nhiều hơn 50 ký tự',
            'phone.required' => 'Không được để trống số điện thoại',
            'phone.min' => 'Số điện thoại chỉ được phép 10 ký tự',
            'phone.max' => 'Số điện thoại chỉ được phép 10 ký tự',
            'address.required' => 'Không được để trống địa chỉ',
            'address.min' => 'Địa chỉ không được ít hơn 5 ký tự và nhiều hơn 100 ký tự',
            'address.max' => 'Địa chỉ không được ít hơn 5 ký tự và nhiều hơn 100 ký tự'
        ];
    }
}
