<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'title',
        'slug',
        'content_type',
        'content',
        'pdf_path',
    ];
    protected $appends = [
        'created_at_formatted'
    ];
    /*
    |--------------------------------------------------------------------------
    | AUTO SLUG
    |--------------------------------------------------------------------------
    */
    protected static function booted()
    {
        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = static::generateUniqueSlug($page->title);
            }
        });

        static::updating(function ($page) {
            if ($page->isDirty('title')) {
                $page->slug = static::generateUniqueSlug($page->title);
            }
        });
    }
    protected static function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $count = static::where('slug', 'LIKE', "{$slug}%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }
    /*
   |--------------------------------------------------------------------------
   | ACCESSOR FORMAT CREATED_AT
   |--------------------------------------------------------------------------
   */
    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at
            ? $this->created_at->format('d M Y H:i')
            : null;
    }
}
