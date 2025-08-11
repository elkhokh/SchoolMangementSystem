<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassesRequest extends FormRequest
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
            'name' => 'required|string|unique:classes',
            'note'       =>   'nullable|string', // is not required
            //    "name" => ["required" , "string" , "max:100" , function($attribute,$value,$fail){
            //     // Closure-based Custom Validation Rule
            //     if(str_contains($value,"Lesson")){
            //         $fail(" $attribute  ميتفعش تضيف كلام فيه الكلمة دي");
            //     }
            // }],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'اسم الفصل مطلوب',
            'name.unique'   => 'اسم الفصل موجود بالفعل',
            'name.string'   => 'اسم الفصل يجب أن يكون نصاً',
            'note.string'   => 'الملاحظات تكون كلام ',

        ];
    }
}
