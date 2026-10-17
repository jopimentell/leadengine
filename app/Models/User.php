<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, HasUuids, Notifiable, SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name', 'slug', 'phone', 'email', 'password', // ADICIONADO password
        'avatar', 'city', 'creci',
        'plan_type', 'trial_ends_at', 'has_custom_domain', 'setup_fee_paid',
        'is_admin', // ADICIONADO
    ];

    protected $casts = [
        'trial_ends_at' => 'datetime',
        'has_custom_domain' => 'boolean',
        'setup_fee_paid' => 'boolean',
        'plan_type' => 'string',
        'is_admin' => 'boolean', // ADICIONADO
    ];

    protected $hidden = [
        'password', // ADICIONADO
        'remember_token',
    ];

    // ===== RELACIONAMENTOS =====
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function leads()
    {
        return $this->hasMany(Lead::class, 'corretor_id');
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function aiCredits()
    {
        return $this->hasOne(AiCredit::class);
    }

    // ===== MÉTODOS DE NEGÓCIO =====
    public function getMaxPropertiesAllowed(): int
    {
        return match ($this->plan_type) {
            'essencial'   => 10,
            'aceleracao'  => 10,
            'performance' => PHP_INT_MAX, // ilimitado
            default       => 10,
        };
    }

    public function getPlanLabelAttribute(): string
    {
        return match ($this->plan_type) {
            'essencial'   => 'Essencial',
            'aceleracao'  => 'Aceleração',
            'performance' => 'Performance',
            default       => ucfirst($this->plan_type),
        };
    }

    public function canAddMoreProperties(): bool
    {
        return $this->properties()->count() < $this->getMaxPropertiesAllowed();
    }

    public function getPublicUrl(): string
    {
        return url("/{$this->slug}");
    }
}