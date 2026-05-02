<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPackage extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'duration',
        'duration_type',
        'price',
        'price_discount',
        'location',
        'departure_city',
        'departure_date',
        'airline',
        'hotel',
        'quota',
        'short_description',
        'description',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];
}
