<?php

namespace App\Console\Commands;

use App\Models\Manager;
use App\Models\DutySchedule;
use Illuminate\Console\Command;
use Carbon\Carbon;

class SetupManagers extends Command
{
    protected $signature = 'managers:setup';
    protected $description = 'Настройка менеджеров и дежурств';

    public function handle()
    {
        $this->info('Очистка таблицы менеджеров...');
        Manager::query()->delete();

        $this->info('Очистка таблицы дежурств...');
        DutySchedule::query()->delete();

        $managers = [
            ['name' => 'Эльвира', 'phone' => '+7 (111) 111-11-11', 'telegram' => '@Elyavitag045', 'sort_order' => 1],
            ['name' => 'Екатерина', 'phone' => '+7 (222) 222-22-22', 'telegram' => '@EkaterinaWoodstream', 'sort_order' => 2],
            ['name' => 'Анна', 'phone' => '+7 (333) 333-33-33', 'telegram' => '@AnnaWoodstream', 'sort_order' => 3],
            ['name' => 'Наталья', 'phone' => '+7 (444) 444-44-44', 'telegram' => '@natasha_tru', 'sort_order' => 4],
            ['name' => 'Ольга', 'phone' => '+7 (555) 555-55-55', 'telegram' => '@maksimowaov', 'sort_order' => 5],
        ];

        $this->info('Создание менеджеров...');
        $createdManagers = [];
        foreach ($managers as $manager) {
            $createdManager = Manager::create([
                'name' => $manager['name'],
                'phone' => $manager['phone'],
                'telegram' => $manager['telegram'],
                'sort_order' => $manager['sort_order'],
                'is_active' => true,
            ]);
            $createdManagers[] = $createdManager;
            $this->info("✓ {$manager['name']} - {$manager['telegram']}");
        }

        $this->info('');
        $this->info('Настройка дежурств с сегодняшнего дня...');
        
        $today = Carbon::today();
        
        foreach ($createdManagers as $index => $manager) {
            $dutyDate = $today->copy()->addDays($index);
            $isCurrent = $index === 0;
            
            DutySchedule::create([
                'duty_date' => $dutyDate,
                'manager_id' => $manager->id,
                'is_current' => $isCurrent,
            ]);
            
            $status = $isCurrent ? '👉 ДЕЖУРИТ СЕГОДНЯ' : '';
            $this->info("✓ {$dutyDate->format('d.m.Y')} - {$manager->name} {$status}");
        }

        $this->info('');
        $this->info('🎉 Готово!');
        $this->info('');
        $this->info('Сегодня дежурит: ' . $createdManagers[0]->name);
        $this->info('Telegram: ' . $createdManagers[0]->telegram);
        $this->info('Телефон: ' . $createdManagers[0]->phone);

        return Command::SUCCESS;
    }
}
