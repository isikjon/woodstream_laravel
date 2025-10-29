<?php

namespace App\Services;

use App\Models\DutySchedule;
use App\Models\Manager;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class DutyScheduleService
{
    public function getTodayDuty()
    {
        return Cache::remember('duty_today_' . now()->format('Y-m-d'), 3600, function () {
            $today = Carbon::today();
            
            $duty = DutySchedule::where('duty_date', $today)
                ->with('manager')
                ->first();
            
            if (!$duty) {
                $duty = $this->assignDutyForDate($today);
            }
            
            return $duty;
        });
    }

    public function assignDutyForDate(Carbon $date)
    {
        $managers = Manager::where('is_active', true)
            ->orderBy('order')
            ->orderBy('name')
            ->get();

        if ($managers->isEmpty()) {
            return null;
        }

        $lastDuty = DutySchedule::where('duty_date', '<', $date)
            ->orderBy('duty_date', 'desc')
            ->first();

        $nextManagerIndex = 0;
        if ($lastDuty) {
            $currentIndex = $managers->search(function ($manager) use ($lastDuty) {
                return $manager->id === $lastDuty->manager_id;
            });
            
            if ($currentIndex !== false) {
                $nextManagerIndex = ($currentIndex + 1) % $managers->count();
            }
        }

        $manager = $managers[$nextManagerIndex];

        return DutySchedule::create([
            'duty_date' => $date,
            'manager_id' => $manager->id,
            'is_current' => true
        ]);
    }

    public function fillScheduleForPeriod(Carbon $startDate, Carbon $endDate)
    {
        $current = $startDate->copy();
        $results = [];

        while ($current->lte($endDate)) {
            $existing = DutySchedule::where('duty_date', $current)->first();
            
            if (!$existing) {
                $results[] = $this->assignDutyForDate($current->copy());
            }
            
            $current->addDay();
        }

        $this->clearDutyCache();

        return $results;
    }

    public function getDutyByDate(Carbon $date)
    {
        return DutySchedule::where('duty_date', $date)
            ->with('manager')
            ->first();
    }

    public function updateCurrentFlags()
    {
        $today = Carbon::today();
        
        DutySchedule::where('is_current', true)
            ->where('duty_date', '!=', $today)
            ->update(['is_current' => false]);
        
        DutySchedule::where('duty_date', $today)
            ->update(['is_current' => true]);
        
        $this->clearDutyCache();
    }

    public function clearDutyCache()
    {
        $date = now()->format('Y-m-d');
        Cache::forget('duty_today_' . $date);
        Cache::forget('duty_phone_' . $date);
        Cache::forget('duty_whatsapp_' . $date);
        Cache::forget('duty_socials_' . $date);
    }
}

