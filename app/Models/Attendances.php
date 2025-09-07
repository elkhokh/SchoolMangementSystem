<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    /** @use HasFactory<\Database\Factories\AttendancesFactory> */
    use HasFactory;
        protected $fillable=[
        'student_id',
        'class_id',
        // 'teacher_id',
        'attendence_date',
        'attendence_status',
    ];

    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }

        public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    // public function teacher()
    // {
    //     return $this->belongsTo(Teacher::class, 'teacher_id');
    // }

}
