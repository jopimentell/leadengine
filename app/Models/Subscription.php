<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'plan_type', 'external_id', 'status',
        'current_period_start', 'current_period_end', 'canceled_at',
    ];

    protected $casts = [
        'current_period_start' => 'datetime',
        'current_period_end' => 'datetime',
        'canceled_at' => 'datetime',
        'status' => 'string',
        'plan_type' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}