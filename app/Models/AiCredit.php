<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiCredit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'total_credits', 'used_credits',
    ];

    protected $casts = [
        'total_credits' => 'integer',
        'used_credits' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAvailableCreditsAttribute(): int
    {
        return $this->total_credits - $this->used_credits;
    }

    public function useCredit(): bool
    {
        if ($this->available_credits > 0) {
            $this->increment('used_credits');
            return true;
        }
        return false;
    }
}