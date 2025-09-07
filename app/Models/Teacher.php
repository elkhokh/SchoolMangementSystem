<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable ,HasRoles ,HasApiTokens ;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id', 'subject_id', 'phone', 'specialization', 'note','gender','address',
    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
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
