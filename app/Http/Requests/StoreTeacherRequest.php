<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|string|min:6|confirmed',
            'subject_id'     => 'required|exists:subjects,id',
            'phone' => 'nullable|string|max:20|unique:teachers,phone',
            'specialization' => 'nullable|string|max:255',
            'gender'     => 'required|in:male,female',
            'address'    => 'nullable|string|max:255',
            'note'           => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'       => 'اسم المدرس مطلوب',
            'email.required'      => 'البريد الإلكتروني مطلوب',
            'email.unique'        => 'هذا البريد مستخدم من قبل',
            'password.required'   => 'كلمة المرور مطلوبة',
            'subject_id.required' => 'المادة مطلوبة',
            'subject_id.exists'   => 'المادة غير صحيحة',
            'phone' => 'الرقم دا موجود قيل كدا ي استاذ',
            'gender.required'     => 'النوع مطلوب.',
            'gender.in'           => 'النوع يجب أن يكون ذكر أو أنثى فقط.',
            'address.string'      => 'العنوان يجب أن يكون نصاً.',
            'address.max'         => 'العنوان يجب ألا يزيد عن 255 حرف.',
        ];
    }
}
