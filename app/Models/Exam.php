<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','subject_id','class_id','exam_date','mark','note', 'status',
    ];


    public function subject()
    {
        return $this->belongsTo(Subjects::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
