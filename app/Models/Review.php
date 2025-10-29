<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'blog';
    
    protected $connection = 'production';
    
    protected $fillable = [
        'name',
        'slug',
        'text',
        'image',
        'tags',
        'type',
        'status',
        'order',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function booted()
    {
        static::addGlobalScope('feedback', function ($query) {
            $query->where('type', 'feedback');
        });
    }

    protected $appends = [
        'image_url',
        'status_label'
    ];

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('images/content/antique_1.png');
        }

        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        if (str_starts_with($this->image, 'images/content/')) {
            return asset($this->image);
        }

        return asset('images/content/' . $this->image);
    }

    public function getStatusLabelAttribute()
    {
        if ($this->status) {
            return 'Опубликован';
        }
        return 'На модерации';
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeModerated($query)
    {
        return $query->where('status', 1);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }
}
