<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Request extends Model
{
    protected $table = 'orders';
    
    protected $connection = 'production';
    
    protected $fillable = [
        'client_id',
        'product_id',
        'offer',
        'status',
        'manager_id',
        'comment',
    ];

    protected $casts = [
        'client_id' => 'integer',
        'product_id' => 'integer',
    ];

    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }

    public function getMessageAttribute()
    {
        return $this->comment ?: '';
    }

    public function getNameAttribute()
    {
        return $this->offer ?: 'Заявка без описания';
    }

    public function getPhoneAttribute()
    {
        return '';
    }

    public function getEmailAttribute()
    {
        return '';
    }

    public function getTypeAttribute()
    {
        return 'order';
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('subject', 'like', "%{$type}%")
                    ->orWhere('content', 'like', "%{$type}%");
    }

    public function scopeRecent($query)
    {
        return $query->where('created_at', '>=', now()->subDays(7));
    }
}