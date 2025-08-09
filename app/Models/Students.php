<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    /** @use HasFactory<\Database\Factories\StudentsFactory> */
    use HasFactory;
      protected $fillable = [
        'user_id', 'class_id', 'gender', 'birth_date', 'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'student_teacher', 'student_id', 'teacher_id')->withTimestamps();
    }

    public function subjects()
    {
        return $this->belongsToMany(Subjects::class, 'student_subject', 'student_id', 'subject_id')->withTimestamps();
    }

    public function attachments()
    {
        return $this->hasMany(StudentsAttachment::class, 'student_id');
    }
}
