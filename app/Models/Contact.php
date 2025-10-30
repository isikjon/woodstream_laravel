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
        if (\Schema::connection('production')->hasColumn('contacts', 'visability')) {
            return $query->where('visability', 1);
        }
        if (\Schema::connection('production')->hasColumn('contacts', 'is_active')) {
            return $query->where('is_active', 1);
        }
        return $query;
    }

    public function scopeOrdered($query)
    {
        if (\Schema::connection('production')->hasColumn('contacts', 'order')) {
            $query->orderBy('order');
        }
        if (\Schema::connection('production')->hasColumn('contacts', 'sort_order')) {
            $query->orderBy('sort_order');
        }
        return $query->orderBy('created_at', 'desc');
    }

    public function setPhoneAttribute($value): void
    {
        $this->attributes['phone'] = preg_replace('/\D+/', '', (string) $value);
    }
}


