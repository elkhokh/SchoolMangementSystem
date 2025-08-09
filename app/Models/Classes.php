<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    /** @use HasFactory<\Database\Factories\ClassesFactory> */
    use HasFactory;
        protected $fillable = [
        'name', 'note',
        // 'created_at','updated_at',
    ];
        protected $casts = [

    ];
        public function teachers()
    {
    return $this->belongsToMany(Teacher::class, 'class_teacher', 'class_id', 'teacher_id')
                    ->withTimestamps();
    }
    public function subjects()
    {
        return $this->belongsToMany(Subjects::class, 'class_subject', 'class_id', 'subject_id')
                    ->withTimestamps();
    }
    public function sessions()
    {
        return $this->hasMany(ClassSession::class, 'class_id');
    }
    public function students()
    {
        return $this->hasMany(Students::class, 'class_id');
    }
}
