<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'tour_package_id',
        'type',
        'name',
    ];
    protected $appends = ['created_at_formatted'];
    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at
            ? $this->created_at->format('d M Y H:i')
            : null;
    }
    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }
}
