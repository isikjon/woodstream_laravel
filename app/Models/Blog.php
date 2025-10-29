<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
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

    protected $attributes = [
        'tags' => '',
    ];

    protected $appends = [
        'image_url',
        'title',
        'excerpt',
    ];

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('images/content/blog-1.png');
        }

        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        if (str_starts_with($this->image, '/')) {
            return 'https://woodstream.online' . $this->image;
        }

        if (str_starts_with($this->image, 'images/')) {
            return 'https://woodstream.online/' . $this->image;
        }

        return asset('images/content/' . $this->image);
    }

    public function getNameAttribute()
    {
        return $this->getAttributes()['name'] ?? '';
    }

    public function getTextAttribute()
    {
        return $this->getAttributes()['text'] ?? '';
    }

    public function getTitleAttribute()
    {
        return $this->getAttributes()['name'] ?? '';
    }

    public function getExcerptAttribute()
    {
        $text = $this->getAttributes()['text'] ?? '';
        if (!$text) {
            return '';
        }
        
        $text = strip_tags($text);
        return mb_substr($text, 0, 150) . '...';
    }
}
