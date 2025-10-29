<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OldCategory extends Model
{
    protected $connection = 'production';
    protected $table = 'categories';
    
    protected $fillable = [
        'name', 'slug', 'parent_id'
    ];

    public function products()
    {
        return $this->belongsToMany(OldProduct::class, 'product_relations', 'id_category', 'id_product');
    }

    public function parent()
    {
        return $this->belongsTo(OldCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(OldCategory::class, 'parent_id');
    }
}
