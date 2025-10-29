<?php

namespace App\Observers;

use App\Models\DutySchedule;
use Illuminate\Support\Facades\Cache;

class DutyScheduleObserver
{
    public function created(DutySchedule $dutySchedule): void
    {
        $this->clearCache();
    }

    public function updated(DutySchedule $dutySchedule): void
    {
        $this->clearCache();
    }

    public function deleted(DutySchedule $dutySchedule): void
    {
        $this->clearCache();
    }

    protected function clearCache(): void
    {
        Cache::forget('duty_phone');
    }
}
