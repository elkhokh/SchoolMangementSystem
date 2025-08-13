<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Subjects;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Helpers\ApiResponse;

class UpdateSubjectsRequest extends FormRequest
{
    // public function authorize(): bool
    // {
    //     return true;
    // }

    // public function rules(): array
    // {
    //     $subject = Subjects::findOrFail($this->route()->parameter('id'));
    //     $rules = [
    //         'note' => 'nullable|string', // غيّرناها لـ nullable زي StoreSubjectsRequest
    //         'degree' => 'nullable|numeric|min:0', // غيّرناها لـ nullable
    //     ];
    //     if ($this->name == $subject->name) {
    //         $rules['name'] = 'required|string|unique:subjects,name,' . $subject->id;
    //     } else {
    //         $rules['name'] = 'required|string|unique:subjects,name';
    //     }
    //     return $rules;
    // }

    // public function messages(): array
    // {
    //     return [
    //         'name.required' => 'اسم المادة مطلوب',
    //         'name.unique' => 'اسم المادة موجود بالفعل',
    //         'name.string' => 'اسم المادة يجب أن يكون نصًا',
    //         'degree.required' => 'الدرجة مطلوبة',
    //         'degree.numeric' => 'الدرجة يجب أن تكون رقمًا',
    //         'degree.min' => 'الدرجة يجب ألا تكون أقل من 0',
    //         'note.string' => 'الوصف يجب أن يكون نصًا',
    //     ];
    // }

    // protected function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(
    //         ApiResponse::error('خطأ في التحقق من البيانات', $validator->errors()->toArray(), 422)
    //     );
    // }
}
