<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable ,HasRoles ,HasApiTokens ;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',

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
        public static function validation(): array
    {
        return [
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:8|confirmed',
            'status'     => 'required|in:0,1',
        ];
    }
    public static function validationMessages(): array
{
    return [
        'name.required'     => 'اسم المستخدم مطلوب.',
        'name.string'       => 'اسم المستخدم يجب أن يكون نصاً.',
        'name.max'          => 'اسم المستخدم يجب ألا يزيد عن 255 حرفاً.',

        'email.required'    => 'البريد الإلكتروني مطلوب.',
        'email.email'       => 'البريد الإلكتروني غير صالح.',
        'email.unique'      => 'البريد الإلكتروني مسجّل بالفعل.',

        'password.required' => 'كلمة المرور مطلوبة.',
        'password.string'   => 'كلمة المرور يجب أن تكون نصاً.',
        'password.min'      => 'كلمة المرور يجب ألا تقل عن 8 أحرف.',
        'password.confirmed'=> 'تأكيد كلمة المرور غير متطابق.',

        'status.required'   => 'الحالة مطلوبة.',
        'status.in'         => 'قيمة الحالة غير صحيحة.',

        'roles_name.required' => 'الأدوار مطلوبة.',
        'roles_name.array'    => 'صيغة الأدوار غير صحيحة.',
    ];
}
    public function student()
    {
    return $this->hasOne(Students::class, 'user_id');
}

    public function teacher()
        {
    return $this->hasOne(Teacher::class, 'user_id');
        }

}
