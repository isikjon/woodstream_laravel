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

        $imagePath = $this->image;
        
        $imagePath = str_replace('\\', '/', $imagePath);
        
        if (str_starts_with($imagePath, '/img/products/')) {
            return 'https://woodstream.online' . $imagePath;
        }
        
        if (str_starts_with($imagePath, 'img/products/')) {
            return 'https://woodstream.online/' . $imagePath;
        }
        
        if (str_starts_with($imagePath, 'images/content/images/')) {
            $imagePath = str_replace('images/content/images/', 'images/', $imagePath);
        }
        
        if (str_starts_with($imagePath, 'images/uploads/')) {
            $imagePath = str_replace('images/uploads/', 'images/content/uploads/', $imagePath);
        }
        
        if (str_starts_with($imagePath, 'uploads/')) {
            $imagePath = 'images/content/' . $imagePath;
        }
        
        if (str_starts_with($imagePath, 'images/content/')) {
            return asset($imagePath);
        }
        
        if (str_starts_with($imagePath, '/')) {
            return asset(ltrim($imagePath, '/'));
        }

        return asset('images/content/' . $imagePath);
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
