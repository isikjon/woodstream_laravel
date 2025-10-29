<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $table = 'managers';
    
    protected $connection = 'production';
    
    protected $fillable = [
        'name',
        'phone',
        'whatsapp',
        'instagram',
        'telegram',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function dutySchedules()
    {
        return $this->hasMany(DutySchedule::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name');
    }

    public function getWhatsappLinkAttribute()
    {
        if (!$this->whatsapp) {
            return null;
        }
        
        $cleanPhone = preg_replace('/[^\d]/', '', $this->whatsapp);
        return "https://wa.me/{$cleanPhone}";
    }

    public function getInstagramLinkAttribute()
    {
        if (!$this->instagram) {
            return null;
        }
        
        $username = ltrim($this->instagram, '@');
        return "https://instagram.com/{$username}";
    }

    public function getTelegramLinkAttribute()
    {
        if (!$this->telegram) {
            return null;
        }
        
        $username = ltrim($this->telegram, '@');
        return "https://t.me/{$username}";
    }
}
