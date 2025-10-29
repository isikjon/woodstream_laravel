<?php

namespace App\Filament\Resources\DutyScheduleResource\Pages;

use App\Filament\Resources\DutyScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDutySchedule extends EditRecord
{
    protected static string $resource = DutyScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
