<?php

// namespace App\Http\Requests;

// use Illuminate\Validation\Rule;
// use Illuminate\Foundation\Http\FormRequest;
// use App\Models\Classes;
// use Illuminate\Contracts\Validation\Validator;
// use Illuminate\Http\Exceptions\HttpResponseException;
// use App\Helpers\ApiResponse;

// class UpdateClassesRequest extends FormRequest
// {
//     public function authorize(): bool
//     {
//         return true; // عدّلها لو عايز شروط أذونات
//     }

//     public function rules(): array
//     {
//         $class = Classes::findOrFail($this->route()->parameter('id'));
//         $rules = [
//             'note' => 'required|string',
//         ];
//         if ($this->name == $class->name) {
//             $rules['name'] = 'required|string|unique:classes,name,' . $class->id;
//         } else {
//             $rules['name'] = 'required|string|unique:classes,name';
//         }
//         return $rules;
//     }

//     public function messages(): array
//     {
//         return [
//             'name.required' => 'اسم الفصل مطلوب',
//             'name.unique' => 'اسم الفصل موجود بالفعل',
//             'name.string' => 'اسم الفصل يجب أن يكون نصًا',
//             'note.required' => 'الوصف مطلوب',
//             'note.string' => 'الوصف يجب أن يكون نصًا',
//         ];
//     }

//     protected function failedValidation(Validator $validator)
//     {
//         throw new HttpResponseException(
//             ApiResponse::error('خطأ في التحقق من البيانات', $validator->errors()->toArray(), 422)
//         );
//     }
// }
