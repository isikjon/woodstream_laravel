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
        
        // Убираем начальный слеш если есть
        $imagePath = ltrim($imagePath, '/');
        
        // Все изображения отзывов берем с продакшн сервера
        // Формат в БД: "uploads/xxx.jpg" или "images/uploads/xxx.jpg"
        
        // Если путь содержит uploads - это изображение отзыва
        if (str_contains($imagePath, 'uploads/')) {
            // Нормализуем путь
            if (str_starts_with($imagePath, 'images/uploads/')) {
                // images/uploads/xxx.jpg -> images/uploads/xxx.jpg
                return 'https://woodstream.online/' . $imagePath;
            } elseif (str_starts_with($imagePath, 'uploads/')) {
                // uploads/xxx.jpg -> images/uploads/xxx.jpg
                return 'https://woodstream.online/images/' . $imagePath;
            }
        }
        
        // Если только имя файла (hash.jpg) - ищем в images/uploads/
        if (!str_contains($imagePath, '/') && str_ends_with($imagePath, '.jpg')) {
            return 'https://woodstream.online/images/uploads/' . $imagePath;
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
