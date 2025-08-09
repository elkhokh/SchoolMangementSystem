<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentsAttachment extends Model
{
    /** @use HasFactory<\Database\Factories\StudentsAttachmentFactory> */
    use HasFactory;

    protected $fillable = [
        'student_id',
        'father_name',
        'mother_name',
        'parent_email',
        'parent_phone',
        'file_name',
        'note',
    ];

    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }
}
