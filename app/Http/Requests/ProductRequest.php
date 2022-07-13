<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_id' => 'required',
            'name' => 'required|unique:products,name,'.$this->id,
            'description' => 'required',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
           // 'image' => 'mimes:jpeg,jpg,png,gif',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'هذا الحقل مطلوب',
            'name.unique' => 'هذا المنتج موجود بالفعل',
           // 'image.mimes' => 'يجب أن تكون الصورة من النوع(jpeg,jpg,png)',
        ];
    }
}
