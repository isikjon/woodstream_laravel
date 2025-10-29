<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = 'page_galleries';
    
    protected $connection = 'production';
    
    protected $fillable = [
        'page_id',
        'title',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    protected $appends = [
        'image_paths'
    ];

    public function scopeActive($query)
    {
        return $query->whereNotNull('images');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function getImagePathsAttribute()
    {
        if (!$this->images || !is_array($this->images)) {
            return [];
        }

        return array_map(function($image) {
            if (str_starts_with($image, 'http')) {
                return $image;
            }
            if (str_starts_with($image, 'images/content/')) {
                return asset($image);
            }
            return asset('images/content/' . $image);
        }, $this->images);
    }
}
