<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
    ];
    protected $appends = ['created_at_formatted'];
    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Parent
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Direct children
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Recursive children (unlimited level)
    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    /*
    |--------------------------------------------------------------------------
    | Boot - Auto Slug
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot(); // WAJIB ADA INI
        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });

        static::updating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }
    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at
            ? $this->created_at->format('d M Y H:i')
            : null;
    }
}
