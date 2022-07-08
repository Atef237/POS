<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->id,
            'image' => 'mimes:jpeg,jpg,png',

        ];
    }

    public function messages()
    {
       return [
           'first_name.required' => 'الاسم الاول مطلوب',
           'last_name.required' => 'الاسم الثاني مطلوب',

           'first_name.string' => 'الاسم الاول يجب ان يكون حروف',
           'last_name.string' => 'الاسم الثاني يجب ان يكون حروف',

           'email.required' => 'البريد الإلكتروني مطلوب',
           'email.email' => 'البريد الإلكتروني غير صالح',
           'email.unique' => 'البريد الإلكتروني موجود بالفعل',

           'permissions.required' => 'الصلاحية مطلوبة',

           'image.mimes' => ' هذا الملف غير مسموح بة يجب ان يكون من نوع "jpeg,jpg,png"'
       ];
    }
}
