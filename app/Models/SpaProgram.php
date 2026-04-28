<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaProgram extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_paket',
        'deskripsi',
        'harga',
        'gambar',
        'is_active',
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'harga' => 'integer',
    ];
    protected $appends = ['gambar_url','created_at_formatted'];
    // accessor untuk format tanggal
    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at
            ? $this->created_at->format('d M Y')
            : null;
    }
    public function getGambarUrlAttribute()
    {
        return $this->gambar
            ? asset('storage/' . $this->gambar)
            : null;
    }
}
