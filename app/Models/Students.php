<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Students extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable ,HasRoles ,HasApiTokens ;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id', 'class_id', 'gender','address' , 'birth_date', 'note',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'remember_token',
    ];

    protected function Name(): Attribute
    {
        //strtolower() lcfirst() ucfirst() ucwords()
        return Attribute::make(
            get: fn (string $value) => ucfirst($value), // accessor to get data
            set: fn (string $value) => lcfirst($value), // mutator to save data
        );
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
    public function attachments() {
    // return $this->hasMany(StudentsAttachment::class, 'student_id');
    return $this->hasOne(StudentsAttachment::class, 'student_id');
}

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'student_teacher', 'student_id', 'teacher_id')->withTimestamps();
    }

    public function subjects()
    {
        return $this->belongsToMany(Subjects::class, 'student_subject', 'student_id', 'subject_id')->withTimestamps();
    }

    // public function attachments()
    // {
    //     return $this->hasMany(StudentsAttachment::class, 'student_id');
    // }
    public function attendances()
    {
        return $this->hasMany(Attendances::class, 'student_id');
    }

        public function grades()
    {
        return $this->hasMany(Grade::class);
    }

public function studentExams()
{
    return $this->hasMany(StudentExam::class, 'student_id');
}
// public function payment(){
//         return $this->hasOne(Payment::class);
// }
public function student()
{
    return $this->belongsTo(Students::class, 'student_id');
}
}
