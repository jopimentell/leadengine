<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id', 'corretor_id', 'lead_name', 'lead_phone',
        'lead_email', 'has_property_to_sell', 'sell_property_details',
        'source', 'status', 'notification_sent_at',
    ];

    protected $casts = [
        'has_property_to_sell' => 'boolean',
        'status' => 'string',
        'notification_sent_at' => 'datetime',
    ];

    // ===== RELACIONAMENTOS =====
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function corretor()
    {
        return $this->belongsTo(User::class, 'corretor_id');
    }

    // ===== SCOPES =====
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeContacted($query)
    {
        return $query->where('status', 'contacted');
    }

    public function scopeConverted($query)
    {
        return $query->where('status', 'converted');
    }

    // ===== MÉTODOS =====
    public function markAsContacted()
    {
        $this->update(['status' => 'contacted']);
    }

    public function markAsConverted()
    {
        $this->update(['status' => 'converted']);
    }
}