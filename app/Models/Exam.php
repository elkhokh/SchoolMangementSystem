<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subject_id',
        'teacher_id',
        'status',
        'start_time',
        'end_time',
        'time_of_exam',
        'note'
    ];


    public function subject()
    {
        return $this->belongsTo(Subjects::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function questions() //exam has many questions
    {
        return $this->hasMany(Question::class);
    }
public function studentExams()
{
    return $this->hasMany(StudentExam::class, 'exam_id');
}
    // public function class()
    // {
    //     return $this->belongsTo(Classes::class);
    // }

    // public function grades()
    // {
    //     return $this->hasMany(Grade::class);
    // }
}
