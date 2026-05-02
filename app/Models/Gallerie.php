<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallerie extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'type',
        'image',
        'youtube_url',
        'is_active',
        'tour_package_id',
    ];
    protected $appends = ['image_url','youtube_thumbnail'];
    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : null;
    }
    public function getYoutubeThumbnailAttribute()
    {
        if (!$this->youtube_url) return null;

        $url = $this->youtube_url;

        // ambil video ID dari berbagai format
        preg_match(
            '/(youtu\.be\/|youtube\.com\/(watch\?v=|embed\/|shorts\/))([^\&\?\n]+)/',
            $url,
            $matches
        );

        $videoId = $matches[3] ?? null;

        return $videoId
            ? 'https://img.youtube.com/vi/' . $videoId . '/hqdefault.jpg'
            : null;
    }
    protected $casts = [
        'is_active' => 'boolean',
    ];
}
