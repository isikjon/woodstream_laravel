<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modal extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'content',
        'button_1_text',
        'button_1_url',
        'button_1_type',
        'button_2_text',
        'button_2_url',
        'button_2_type',
        'image',
        'image_mobile',
        'is_active',
        'delay_seconds',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'delay_seconds' => 'integer',
        'order' => 'integer'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public static function getActiveModals()
    {
        return self::where('is_active', true)
            ->orderBy('order')
            ->get();
    }

    public static function getActiveModal($slug = 'telegram-info')
    {
        return self::where('slug', $slug)
            ->where('is_active', true)
            ->first();
    }
}

