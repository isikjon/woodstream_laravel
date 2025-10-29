<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
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
        'published_at',
        'views_count',
        'sort_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'meta_keywords' => 'array',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                    ->where(function ($q) {
                        $q->whereNull('published_at')
                          ->orWhere('published_at', '<=', now());
                    });
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('published_at', 'desc');
    }

    public function incrementViews()
    {
        $this->increment('views_count');
    }
}