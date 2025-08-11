<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classes extends Model
{
    /** @use HasFactory<\Database\Factories\ClassesFactory> */
    use HasFactory;
        protected $fillable = [
        'name', 'note'
        // 'created_at','updated_at',
    ];
    protected $casts = [
    'created_at' => 'datetime:Y-m-d H:i:s',//fomate data to api
    'updated_at' => 'datetime:Y-m-d H:i:s',// formate data to api
    ];


    protected function Name(): Attribute
    {
        //strtolower() lcfirst() ucfirst() ucwords()
        return Attribute::make(

            get: fn (string $value) => ucfirst($value), // accessor to get data
            set: fn (string $value) => lcfirst($value), // mutator to save data

            // get: fn (string $value) => lcfirst($value), // accessor to get data
            // set: fn (string $value) => ucfirst($value), // mutator to save data
        );
    }


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
