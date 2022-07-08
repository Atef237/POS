<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'password' => 'required|confirmed|min:5',
            'permissions' => 'required|array|min:1',
            'image' => 'mimes:jpeg,jpg,png,gif',
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

            'password.required' =>'كلمة المرور مطلوبة',
            'password.confirmed' =>'كلمة المرور غير مطابقة',
            'password.min' =>'يجب ان لا تقل كلمة المرور 5 احرف',

            'permissions.required' => 'الصلاحية مطلوبة',


        ];
    }
}
