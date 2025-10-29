<?php

namespace App\Filament\Resources\DutyScheduleResource\Pages;

use App\Filament\Resources\DutyScheduleResource;
use App\Models\Manager;
use App\Models\DutySchedule;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;

class ListDutySchedules extends ListRecords
{
    protected static string $resource = DutyScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Назначить дежурство'),
        ];
    }
}
