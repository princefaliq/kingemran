<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $table = 'menu_items';
    protected $fillable = [
        'name',
        'type',
        'page_id',
        'link',
        'parent_id',
        'order',
    ];
    protected $appends = ['type_label','created_at_formatted'];

    /**
     * Parent Menu
     */
    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }
    /**
     * Children Menu
     */
    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')
            ->orderBy('order', 'asc')
            ->with('children'); // recursive di sini
    }

    /**
     * Page Relation (kalau type = page)
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
    public function getTypeLabelAttribute()
    {
        return match ($this->type) {
            'page' => 'Page',
            'route' => 'Internal Route',
            'url' => 'External URL',
            'group' => 'Dropdown / Group',
            default => '-'
        };
    }
    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at
            ? $this->created_at->format('d M Y H:i')
            : null;
    }
    public function getUrlAttribute()
    {
        if ($this->type === 'route') {
            return url($this->link);
        }

        if ($this->type === 'page' && $this->page) {
            return url($this->page->slug);
        }

        if ($this->type === 'url') {
            return $this->link;
        }

        return '#';
    }

}
