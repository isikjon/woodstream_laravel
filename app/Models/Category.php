<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    
    protected $fillable = [
        'name',
        'slug',
        'description',
        'ico',
        'order',
        'status',
        'parent_id',
        'old_url',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
