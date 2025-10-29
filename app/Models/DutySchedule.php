<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DutySchedule extends Model
{
    protected $table = 'duty_schedules';
    
    protected $connection = 'production';
    
    protected $fillable = [
        'duty_date',
        'manager_id',
        'is_current'
    ];

    protected $casts = [
        'duty_date' => 'date',
        'is_current' => 'boolean'
    ];

    public function manager(): BelongsTo
    {
        return $this->belongsTo(Manager::class);
    }

    public function scopeCurrent($query)
    {
        return $query->where('is_current', 1);
    }

    public function scopeByDate($query, $date)
    {
        return $query->where('duty_date', $date);
    }

    public static function getCurrentDuty()
    {
        return self::current()->with('manager')->first();
    }

    public static function setDutyForDate($date, $managerId)
    {
        self::where('duty_date', $date)->update(['is_current' => false]);
        
        return self::updateOrCreate(
            ['duty_date' => $date],
            ['manager_id' => $managerId, 'is_current' => true]
        );
    }
}