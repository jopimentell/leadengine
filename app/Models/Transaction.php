<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'amount', 'type', 'payment_method',
        'status', 'due_date', 'paid_at', 'receipt_url',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'due_date' => 'date',
        'paid_at' => 'datetime',
        'status' => 'string',
        'type' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}