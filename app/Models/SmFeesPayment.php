<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmFeesPayment extends Model
{
    use HasFactory;

    protected $table = 'sm_fees_payments';

    protected $fillable = [
        'amount',
        'payment_date',
        'payment_mode',
        'created_at',
        'updated_at',
        'student_id',
        'fees_type_id',
    ];
}
