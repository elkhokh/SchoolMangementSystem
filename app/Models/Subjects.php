<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    /** @use HasFactory<\Database\Factories\SubjectsFactory> */
    use HasFactory;


    protected $fillable = [
        'name', 'degree', 'note',
    ];

    public function classes()
    {
        return $this->belongsToMany(Classes::class, 'class_subject', 'subject_id', 'class_id')->withTimestamps();
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'subject_id');
    }

    public function students()
    {
        return $this->belongsToMany(Students::class, 'student_subject', 'subject_id', 'student_id')->withTimestamps();
    }

    public function sessions()
    {
        return $this->hasMany(ClassSession::class, 'subject_id');
    }

    public function exams()
    {
    return $this->hasMany(Exam::class, 'subject_id');
    }




}
