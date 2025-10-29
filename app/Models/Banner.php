<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';
    
    protected $fillable = [
        'name',
        'title',
        'text',
        'background',
        'icon',
        'background_color',
        'text_color',
        'button_background_color',
        'button_text_color',
        'link',
        'button_text',
        'is_enabled',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_enabled', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('name', $type);
    }

    public function scopeCurrent($query)
    {
        return $query->where('is_enabled', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}