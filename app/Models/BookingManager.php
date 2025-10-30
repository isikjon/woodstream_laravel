<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingManager extends Model
{
    protected $table = 'booking_managers';
    
    protected $connection = 'production';
    
    protected $fillable = [
        'name',
        'phone',
        'email',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function bookedProducts()
    {
        return $this->hasMany(OldProduct::class, 'booked_by');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name');
    }
}

