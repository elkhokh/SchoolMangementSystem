<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
        'student_id'   => 'required|exists:students,id',
        'payment_type' => 'required|in:cash,paymob,myfatoorah,paypal',
        'amount'       => 'required|numeric|min:1',
    ];
}

public function messages(): array
{
    return [
        'student_id.required' => 'الطالب مطلوب',
        'student_id.exists'   => 'الطالب غير موجود',
        'payment_type.required' => 'نوع الدفع مطلوب',
        'payment_type.in'       => 'نوع الدفع غير صحيح',
        'amount.required' => 'المبلغ مطلوب',
        'amount.numeric'  => 'المبلغ يجب أن يكون رقم',
        'amount.min'      => 'المبلغ يجب أن يكون أكبر من صفر',
    ];
}

}
