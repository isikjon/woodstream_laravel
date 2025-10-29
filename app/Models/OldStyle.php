<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OldStyle extends Model
{
    protected $connection = 'production';
    protected $table = 'styles';
    
    protected $fillable = [
        'name'
    ];

    public function products()
    {
        return $this->belongsToMany(OldProduct::class, 'product_styles', 'style_id', 'product_id');
    }
}
