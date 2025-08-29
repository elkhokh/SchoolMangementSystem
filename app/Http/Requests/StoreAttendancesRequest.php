<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttendancesRequest extends FormRequest
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
   public function rules()
    {
        return [
            'attendance' =>   'required|array',
            'attendance.*' =>  'required|in:1,0',
            'class_id' =>  'required|array',
            'class_id.*' =>    'required|exists:classes,id',
            'attendence_date' => 'required|date',
        ];
    }
    public function messages()
    {
        return [
            'attendance.required' => ' اختار حالة الحضور لكل طالب.',
            'attendance.*.in' => 'حالة الحضور غير صالحة.',
            'class_id.required' => 'رقم الفصل مش موجود لطالب.',
            'class_id.*.exists' => 'الفصل غير موجود.',
            'attendence_date.required' => 'تاريخ الحضور مطلوب.',
            'attendence_date.date' => 'التاريخ غير صحيح.',
        ];
    }
}
