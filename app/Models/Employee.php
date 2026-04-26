<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'position',
        'phone',
        'photo',
        'is_active',
    ];
    protected $appends = ['photo_url', 'created_at_formatted'];

    public function getPhotoUrlAttribute()
    {
        return $this->photo
            ? asset('storage/' . $this->photo)
            : null;
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at->format('d M Y');
    }
}
