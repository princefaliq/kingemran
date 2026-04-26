<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baner extends Model
{
    use HasFactory;
    protected $table = 'baner';
    protected $fillable = [
        'name','image','text','status'
    ];
    protected $appends = ['image_url','created_at_formatted'];

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }
    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at->format('d M Y');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
