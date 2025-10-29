<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OldProduct extends Model
{
    protected $connection = 'production';
    protected $table = 'products';
    
    protected $fillable = [
        'name', 'slug', 'model', 'description', 'size', 'material', 
        'price', 'special', 'availability', 'status', 'online',
        'images', 'avatar', 'video', 'comment', 'city_id',
        'id_country', 'id_style', 'arrived_at', 'priority',
        'booked_at', 'booked_expire', 'availability_last', 'expired_days',
        'century', 'old_url', 'order', 'booked_by', 'has_old_images'
    ];

    protected $casts = [
        'images' => 'array',
        'arrived_at' => 'datetime',
        'booked_at' => 'datetime',
        'booked_expire' => 'datetime',
    ];

    public function categories()
    {
        return $this->belongsToMany(OldCategory::class, 'product_relations', 'id_product', 'id_category');
    }

    public function city()
    {
        return $this->belongsTo(OldCity::class, 'city_id');
    }

    public function country()
    {
        return $this->belongsTo(OldCountry::class, 'id_country');
    }

    public function status()
    {
        return $this->belongsTo(OldStatus::class, 'availability');
    }

    public function styles()
    {
        return $this->belongsToMany(OldStyle::class, 'product_styles', 'product_id', 'style_id');
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 0, '.', ' ');
    }

    public function getFormattedSpecialAttribute()
    {
        return $this->special ? number_format($this->special, 0, '.', ' ') : null;
    }

    public function getGalleryAttribute()
    {
        $images = is_array($this->images) ? $this->images : json_decode($this->images, true);
        if (is_array($images) && !empty($this->avatar)) {
            $images = array_filter($images, function($img) {
                return $img !== $this->avatar;
            });
        }
        
        // Добавляем полные URL для изображений
        $images = array_map(function($img) {
            if (!str_starts_with($img, 'http')) {
                $img = 'https://woodstream.online' . $img;
            }
            // Исправляем неправильные пути
            $img = str_replace('woodstream.onlineimages', 'woodstream.online/images', $img);
            return $img;
        }, $images ?: []);
        
        return $images;
    }

    public function getMainImageAttribute()
    {
        $avatar = $this->avatar;
        if ($avatar && !str_starts_with($avatar, 'http')) {
            $avatar = 'https://woodstream.online' . $avatar;
        }
        
        if (!$avatar) {
            $images = is_array($this->images) ? $this->images : json_decode($this->images, true);
            if ($images && count($images) > 0) {
                $avatar = $images[0];
                if (!str_starts_with($avatar, 'http')) {
                    $avatar = 'https://woodstream.online' . $avatar;
                }
            }
        }
        
        // Исправляем неправильные пути
        if ($avatar) {
            $avatar = str_replace('img/products/', '/img/products/', $avatar);
            $avatar = str_replace('//', '/', $avatar);
            $avatar = str_replace('https:/woodstream.online', 'https://woodstream.online', $avatar);
            $avatar = str_replace('woodstream.onlineimages', 'woodstream.online/images', $avatar);
        }
        
        // Fallback изображение если основное недоступно
        if (!$avatar) {
            $avatar = 'https://via.placeholder.com/300x300/cccccc/666666?text=No+Image';
        }
        
        return $avatar;
    }

    public function getPhotoUrlAttribute()
    {
        return $this->main_image;
    }
}
