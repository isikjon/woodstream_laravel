<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'subscription',
        'manager_id',
        'comment',
    ];

    protected $casts = [
        'subscription' => 'boolean',
    ];

    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }

    public function scopeActive($query)
    {
        return $query->where('subscription', true);
    }

    public function scopeRecent($query)
    {
        return $query->where('created_at', '>=', now()->subDays(30));
    }
}