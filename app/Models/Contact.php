<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $connection = 'production';
    
    protected $fillable = [
        'name',
        'phone',
        'telegram',
        'instagram',
        'avatar',
        'order',
        'visability',
    ];

    protected $casts = [
        'visability' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('visability', 1);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }

    public function setPhoneAttribute($value): void
    {
        $this->attributes['phone'] = preg_replace('/\D+/', '', (string) $value);
    }
}


