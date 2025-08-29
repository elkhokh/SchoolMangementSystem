<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherRequest extends FormRequest
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

    $teacher = $this->teacher; // teacher == user_id
    return [
        'name'           => 'required|string|max:255',
        // 'email' => 'required|email|unique:users,email',
        'email'          => ['required','email', Rule::unique('users', 'email')->ignore($teacher->user_id)],
        'password'       => 'nullable|string|min:6|confirmed',
        'subject_id'     => 'required|exists:subjects,id',
        // 'phone' => 'nullable|string|max:20|unique:teachers,phone',
        'phone'          => ['nullable','string','max:20', Rule::unique('teachers', 'phone')->ignore($teacher->id)],
        'specialization' => 'nullable|string|max:255',
        'gender'         => 'required|in:male,female',
        'address'        => 'nullable|string|max:255',
        'note'           => 'nullable|string',
        'status'         => 'required|in:0,1',
    ];
}
    public function messages(): array
    {
        return [
            'name.required'       => 'اسم المدرس مطلوب',
            'email.required'      => 'البريد الإلكتروني مطلوب',
            'email.unique'        => 'هذا البريد مستخدم من قبل',
            'password.min'        => 'كلمة المرور يجب ألا تقل عن 6 أحرف',
            'subject_id.required' => 'المادة مطلوبة',
            'subject_id.exists'   => 'المادة غير صحيحة',
            'phone.unique'        => 'الرقم دا موجود من قبل',
            'gender.required'     => 'النوع مطلوب',
            'gender.in'           => 'النوع يجب أن يكون ذكر أو أنثى فقط',
            'address.max'         => 'العنوان يجب ألا يزيد عن 255 حرف',
        ];
    }
}
