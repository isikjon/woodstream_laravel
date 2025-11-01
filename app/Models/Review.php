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

        // Если уже полный URL - возвращаем как есть
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        $imagePath = $this->image;
        $imagePath = str_replace('\\', '/', $imagePath);
        $imagePath = ltrim($imagePath, '/');
        
        // В БД: images/content/uploads/xxx.jpg
        // На диске: images/uploads/xxx.jpg
        // Убираем "/content" из пути
        $imagePath = str_replace('images/content/uploads/', 'images/uploads/', $imagePath);
        
        // Все изображения с uploads/ грузим с продакшна
        if (str_contains($imagePath, 'uploads/')) {
            return 'https://woodstream.online/' . $imagePath;
        }
        
        // Все остальное - локальные ассеты
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
