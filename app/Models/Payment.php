<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_email',
        'amount',
        'payment_gateway',
        'transaction_id',
        'status',
    ];
}
