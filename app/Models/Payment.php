<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'student_id',
        'payment_type',
        'payment_status',
        'payment_id',
        'payment_url',
        'amount_all',
        'remaining',
        'current_paid',
    ];
    public function student()
    {
        return $this->belongsTo(Students::class);
    }

}
