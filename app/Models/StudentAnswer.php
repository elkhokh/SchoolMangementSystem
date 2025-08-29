<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    /** @use HasFactory<\Database\Factories\StudentAnswerFactory> */
    use HasFactory;
protected $fillable = [
        'student_exam_id',
        'question_id', 'option_id',
        'answer_text'
    ];
public function studentExam()
    {
        return $this->belongsTo(StudentExam::class);
    }
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
