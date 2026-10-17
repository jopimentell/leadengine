<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id', 'slug', 'title', 'description', 'price', 'price_rent',
        'street', 'neighborhood', 'city', 'state', 'latitude', 'longitude',
        'bedrooms', 'bathrooms', 'area_sqmt', 'status',
        'views_count', 'lead_count',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'price_rent' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'area_sqmt' => 'decimal:2',
        'views_count' => 'integer',
        'lead_count' => 'integer',
        'status' => 'string',
    ];

    // ===== RELACIONAMENTOS =====
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class)->orderBy('order');
    }

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    // ===== MUTATORS =====
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        if (empty($this->attributes['slug'])) {
            $this->attributes['slug'] = Str::slug($value) . '-' . Str::random(6);
        }
    }

    // ===== SCOPES =====
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFilterByPrice($query, $min, $max)
    {
        if ($min) $query->where('price', '>=', $min);
        if ($max) $query->where('price', '<=', $max);
        return $query;
    }

    public function scopeFilterByBedrooms($query, $bedrooms)
    {
        if ($bedrooms && $bedrooms != 'any') {
            if ($bedrooms == '4+') {
                $query->where('bedrooms', '>=', 4);
            } else {
                $query->where('bedrooms', $bedrooms);
            }
        }
        return $query;
    }

    public function scopeFilterByCity($query, $city)
    {
        if ($city) {
            return $query->where('city', $city);
        }
        return $query;
    }

    public function scopeSearch($query, $term)
    {
        if ($term) {
            return $query->where('title', 'LIKE', "%{$term}%")
                         ->orWhere('street', 'LIKE', "%{$term}%")
                         ->orWhere('neighborhood', 'LIKE', "%{$term}%")
                         ->orWhere('city', 'LIKE', "%{$term}%");
        }
        return $query;
    }

    public function getMainImageAttribute(): ?string
    {
        $first = $this->images()->first();
        return $first ? $first->url : null;
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'R$ ' . number_format($this->price, 2, ',', '.');
    }

    public function getFullAddressAttribute(): string
    {
        $parts = array_filter([
            $this->street,
            $this->neighborhood,
            $this->city,
            $this->state,
        ]);
        return implode(', ', $parts);
    }
}