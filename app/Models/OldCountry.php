<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OldCountry extends Model
{
    protected $connection = 'production';
    protected $table = 'countries';
    
    protected $fillable = [
        'name'
    ];

    public function products()
    {
        return $this->hasMany(OldProduct::class, 'id_country');
    }
}
