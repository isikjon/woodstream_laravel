<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $connection = 'production';
    
    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->belongsToMany(OldProduct::class, 'product_materials', 'id_material', 'id_product');
    }
}

