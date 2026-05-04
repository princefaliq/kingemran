<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'tour_package_id',
        'content',
        'rating',
        'is_active',
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
        if (!$this->image) {
            return 'https://placehold.co/350x335';
        }
        return asset('storage/' . $this->image);
    }
    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }
}
