<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|min:1|unique:clients,phone,'.$this->id,
            'phone.*' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'هذا الحقل مطلوب',
            'phone.*'=>'هذا الحقل مطلوب',
            'image.mimes' => 'يجب أن تكون الصورة من النوع(jpeg,jpg,png)'
        ];
    }
}
