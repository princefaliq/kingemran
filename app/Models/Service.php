<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'icon',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Optional: format tanggal biar rapi di frontend
    protected $appends = ['created_at_formatted'];

    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at
            ? $this->created_at->format('d M Y')
            : null;
    }
}
