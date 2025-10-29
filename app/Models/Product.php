<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'code',
        'price',
        'image',
        'is_new',
        'is_available',
        'order',
        'is_active',
        'description',
        'style',
        'city',
        'century',
        'country',
        'images',
        'created_date',
        'discount',
        'status',
        'manager_id',
        'booking_date',
        'booking_client_name',
        'booking_client_phone',
        'booking_notes',
    ];

    protected $casts = [
        'is_new' => 'boolean',
        'is_available' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'images' => 'array',
        'created_date' => 'date',
        'booking_date' => 'datetime',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }
}
