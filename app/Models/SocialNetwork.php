<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{
    protected $table = 'socials';
    
    protected $connection = 'production';
    
    protected $fillable = [
        'title',
        'class',
        'link',
        'ico',
        'is_enabled'
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_enabled', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('title');
    }

    public function getSlugAttribute()
    {
        return $this->class;
    }

    public function getUrlAttribute()
    {
        return $this->link;
    }

    public function getIconAttribute()
    {
        return $this->ico;
    }
}