<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OldCity extends Model
{
    protected $connection = 'production';
    protected $table = 'cities';
    
    protected $fillable = [
        'name'
    ];

    public function products()
    {
        return $this->hasMany(OldProduct::class, 'city_id');
    }
}
