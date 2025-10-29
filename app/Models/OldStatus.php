<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OldStatus extends Model
{
    protected $connection = 'production';
    protected $table = 'product_statuses';
    
    protected $fillable = [
        'name'
    ];

    public function products()
    {
        return $this->hasMany(OldProduct::class, 'availability');
    }
}
