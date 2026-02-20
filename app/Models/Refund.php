<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $fillable = [
        'order_id',
        'reason',
        'bank_name',
        'account_number',
        'account_name',
        'status',
        'admin_notes',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
