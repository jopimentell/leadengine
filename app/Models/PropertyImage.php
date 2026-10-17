<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id', 'url', 'order', 'is_enhanced',
    ];

    protected $casts = [
        'order' => 'integer',
        'is_enhanced' => 'boolean',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}