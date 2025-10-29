<?php

namespace App\Console\Commands;

use App\Models\Manager;
use App\Models\DutySchedule;
use Illuminate\Console\Command;
use Carbon\Carbon;

class RotateDutyManager extends Command
{
    protected $signature = 'duty:rotate';
    protected $description = 'Автоматическая смена дежурного менеджера';

    public function handle()
    {
        $this->info('Начинаем смену дежурного менеджера...');

        $currentDuty = DutySchedule::where('is_current', true)->first();
        
        if ($currentDuty) {
            $currentDuty->update(['is_current' => false]);
            $this->info('Снят с дежурства: ' . $currentDuty->manager->name);
        }

        $managers = Manager::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        if ($managers->isEmpty()) {
            $this->error('Нет активных менеджеров!');
            return Command::FAILURE;
        }

        $currentManagerIndex = 0;
        if ($currentDuty) {
            $currentManagerIndex = $managers->search(function ($manager) use ($currentDuty) {
                return $manager->id === $currentDuty->manager_id;
            });
            
            if ($currentManagerIndex === false) {
                $currentManagerIndex = 0;
            } else {
                $currentManagerIndex = ($currentManagerIndex + 1) % $managers->count();
            }
        }

        $nextManager = $managers[$currentManagerIndex];
        
        $newDuty = DutySchedule::create([
            'duty_date' => Carbon::today(),
            'manager_id' => $nextManager->id,
            'is_current' => true,
        ]);

        $this->info('✓ Новый дежурный: ' . $nextManager->name);
        $this->info('  Телефон: ' . $nextManager->phone);
        $this->info('  Telegram: ' . $nextManager->telegram);

        cache()->forget('duty_phone');

        $this->info('🎉 Смена завершена!');

        return Command::SUCCESS;
    }
}
