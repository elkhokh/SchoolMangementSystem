<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id', 'subject_id', 'phone', 'specialization', 'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subjects::class);
    }

    public function classes()
    {
        return $this->belongsToMany(Classes::class, 'class_teacher', 'teacher_id', 'class_id')->withTimestamps();
    }

    public function students()
    {
        return $this->belongsToMany(Students::class, 'student_teacher', 'teacher_id', 'student_id')->withTimestamps();
    }

    public function sessions()
    {
        return $this->hasMany(ClassSession::class, 'teacher_id');
    }




}
