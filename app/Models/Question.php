<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory;
        protected $fillable = [
        'exam_id',
        'question_text',
        'type',
        'mark',
        'keywords'
    ];
    public function exam()
    {
    return $this->belongsTo(Exam::class);
    }
    public function options()
    {
        return $this->hasMany(Option::class);
    }
    public function studentAnswers()
    {
        return $this->hasMany(StudentAnswer::class);
    }
}
