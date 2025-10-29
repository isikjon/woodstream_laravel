<?php

namespace App\Console\Commands;

use App\Services\DutyScheduleService;
use Illuminate\Console\Command;
use Carbon\Carbon;

class RotateDutyManager extends Command
{
    protected $signature = 'duty:rotate {--days=30 : Количество дней для заполнения расписания}';
    protected $description = 'Автоматическая смена дежурного менеджера и заполнение расписания';

    protected $dutyService;

    public function __construct(DutyScheduleService $dutyService)
    {
        parent::__construct();
        $this->dutyService = $dutyService;
    }

    public function handle()
    {
        $this->info('🔄 Обновление расписания дежурств...');

        $this->dutyService->updateCurrentFlags();
        $this->info('✓ Флаги is_current обновлены');

        $days = (int) $this->option('days');
        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays($days);

        $this->info("📅 Заполняем расписание с {$startDate->format('d.m.Y')} по {$endDate->format('d.m.Y')}");

        $created = $this->dutyService->fillScheduleForPeriod($startDate, $endDate);

        if (!empty($created)) {
            $this->info('✓ Создано новых записей: ' . count($created));
        } else {
            $this->info('✓ Расписание уже заполнено');
        }

        $todayDuty = $this->dutyService->getTodayDuty();
        
        if ($todayDuty && $todayDuty->manager) {
            $this->info('');
            $this->info('👤 Дежурный на сегодня:');
            $this->info('   Имя: ' . $todayDuty->manager->name);
            $this->info('   Телефон: ' . $todayDuty->manager->phone);
            $this->info('   Telegram: ' . $todayDuty->manager->telegram);
        }

        $this->info('');
        $this->info('🎉 Готово!');

        return Command::SUCCESS;
    }
}
