<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id', 'subject_id', 'phone', 'specialization', 'note','gender','address',
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
    public function exams(){
        return $this->hasMany(Exam::class);}

    // public function attendances()
    // {
    //     return $this->hasMany(Attendances::class, 'teacher_id');
    // }
    // local scope
    // public function scopeSearch($QuerySearch, $sear)
    // {
    //     if ($sear) {
    //     $QuerySearch->whereRelation('user', 'name', 'like', "%{$sear}%");
    //     }
    // }



}
