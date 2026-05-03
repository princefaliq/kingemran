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
        'currency',
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
    protected $appends = ['created_at_formatted','image_url'];
    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at
            ? $this->created_at->format('d M Y H:i')
            : null;
    }
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->thumbnail);
    }
    // TourPackage.php
    public function items()
    {
        return $this->hasMany(PackageItem::class);
    }

    public function itineraries()
    {
        return $this->hasMany(Itinerary::class);
    }
    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }
    public function galleries()
    {
        return $this->hasMany(Gallerie::class);
    }
}
