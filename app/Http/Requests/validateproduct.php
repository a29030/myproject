<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validateproduct extends FormRequest
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
            'nameproduct' => 'required|min:3|max:100',
            'linkimage' => 'required|min:10|max:100',
            'price' => 'required|numeric|between:0,1000000000',
            'sale' => 'required|numeric|between:0,100',
            'quantity' => 'required|numeric|between:0,10000',
        ];
    }

    public function messages()
    {
        return [
            // 'nameproduct.required' => "Vui lòng điền tên sản phẩm",
            // 'nameproduct.min' => 'Tên sản phẩm không được ít hơn 3 và nhiều hơn 100 kí tự',
            // 'nameproduct.max' => 'Tên sản phẩm không được ít hơn 3 và nhiều hơn 100 kí tự',
            // 'linkimage.required' => 'Vui lòng điền link ảnh sản phẩm',
            // 'linkimage.min' => 'Link ảnh sản phẩm không được ít hơn 10 và nhiều hơn 100 kí tự',
            // 'linkimage.max' => 'Link ảnh sản phẩm không được ít hơn 10 và nhiều hơn 100 kí tự',
            // 'price.required' => "Vui lòng điền giá sản phẩm",
            // 'price.min' => 'Giá sản phẩm không được ít hơn 4 và nhiều hơn 10 kí tự',
            // 'price.max' => 'Giá sản phẩm không được ít hơn 4 và nhiều hơn 10 kí tự',
            // 'sale.required' => "Vui lòng điền giảm giá sản phẩm",
            // 'sale.max' => 'Giảm giá sản phẩm không được nhiều hơn 3 kí tự',
            // // 'sale.between' => 'Giảm giá sản phẩm không được nhiều hơn 3 kí tự',
            // 'quantity.required' => "Vui lòng điền số lượng sản phẩm",
            // 'quantity.max' => 'Giảm giá sản phẩm không được nhiều hơn 10 kí tự'
        ];
    }
}
