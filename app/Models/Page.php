<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_published',
        'show_in_menu',
        'sort_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'show_in_menu' => 'boolean',
        'meta_keywords' => 'array',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeInMenu($query)
    {
        return $query->where('show_in_menu', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }
}