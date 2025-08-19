<?php

namespace App\Helpers;

class ValidationHelper
{
    //validation el studentssssssssssssss
public static function studentRules(): array{
        return [
            // Validation userssssssssssssssssssssssssssssssss
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:8|confirmed',
            'status'     => 'required|in:0,1',
            // Validation student infoooooooooooooooooooooooo
            'class_id'   => 'required|exists:classes,id',
            'gender'     => 'required|in:male,female',
            'birth_date' => 'required|date',
            'address'    => 'nullable|string|max:255',
            'note'       => 'nullable|string|max:500',
            // Validation student attachmentsssssssssssssssssssss
            'father_name'   => 'required|string|max:255',
            'mother_name'   => 'required|string|max:255',
            'parent_email'  => 'nullable|email|max:255',
            'parent_phone'  => 'nullable|string|max:20',
            'file_name'     => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'attachment_note' => 'nullable|string|max:500',
        ];
    }
    public static function studentMessages(): array{
        return [
            // Users validation messagesssssssssssssssssssssssssss
            'name.required'      => 'اسم المستخدم مطلوب.',
            'name.max'           => 'اسم المستخدم يجب ألا يزيد عن 255 حرفاً.',
            'email.required'     => 'البريد الإلكتروني مطلوب.',
            'email.email'        => 'البريد الإلكتروني غير صالح.',
            'email.unique'       => 'البريد الإلكتروني مسجّل بالفعل.',
            'password.required'  => 'كلمة المرور مطلوبة.',
            'password.min'       => 'كلمة المرور يجب ألا تقل عن 8 أحرف.',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',
            'status.required'    => 'الحالة مطلوبة.',
            'status.in'          => 'قيمة الحالة غير صحيحة.',
            // Students validation messagessssssssssssssssssssssss
            'class_id.required'   => 'الفصل مطلوب.',
            'class_id.exists'     => 'الفصل المختار غير موجود.',
            'gender.required'     => 'النوع مطلوب.',
            'gender.in'           => 'النوع يجب أن يكون ذكر أو أنثى فقط.',
            'birth_date.required' => 'تاريخ الميلاد مطلوب.',
            'birth_date.date'     => 'تاريخ الميلاد غير صالح.',
            'address.string'      => 'العنوان يجب أن يكون نصاً.',
            'address.max'         => 'العنوان يجب ألا يزيد عن 255 حرف.',
            'note.string'         => 'الملاحظة يجب أن تكون نصاً.',
            'note.max'            => 'الملاحظة يجب ألا تزيد عن 500 حرف.',
            // Student attachments validation messagessssssssssssssss
            'father_name.required'    => 'اسم الأب مطلوب.',
            'father_name.max'         => 'اسم الأب يجب ألا يزيد عن 255 حرف.',
            'mother_name.required'    => 'اسم الأم مطلوب.',
            'mother_name.max'         => 'اسم الأم يجب ألا يزيد عن 255 حرف.',
            'parent_email.email'      => 'البريد الإلكتروني لولي الأمر غير صالح.',
            'parent_email.max'        => 'البريد الإلكتروني لولي الأمر يجب ألا يزيد عن 255 حرف.',
            'parent_phone.max'        => 'رقم هاتف ولي الأمر يجب ألا يزيد عن 20 رقم.',
            'file_name.file'          => 'يجب رفع ملف صالح.',
            'file_name.mimes'         => 'نوع الملف يجب أن يكون jpg أو jpeg أو png أو pdf فقط.',
            'file_name.max'           => 'حجم الملف يجب ألا يزيد عن 2 ميجابايت.',
            'attachment_note.string'  => 'الملاحظة يجب أن تكون نصاً.',
            'attachment_note.max'     => 'الملاحظة يجب ألا تزيد عن 500 حرف.',
        ];
    }
    // public static function teacherRules(): array
    // {
    //     return [
    //         'name'       => 'required|string|max:255',
    //         'email'      => 'required|email|unique:users,email',
    //         'password'   => 'nullable|string|min:8|confirmed',
    //         'status'     => 'required|in:0,1',
    //         'subject_id' => 'required|exists:subjects,id',
    //     ];
    // }
}

