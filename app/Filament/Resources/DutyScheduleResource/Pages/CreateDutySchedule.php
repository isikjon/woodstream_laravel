<?php

namespace App\Filament\Resources\DutyScheduleResource\Pages;

use App\Filament\Resources\DutyScheduleResource;
use App\Models\DutySchedule;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDutySchedule extends CreateRecord
{
    protected static string $resource = DutyScheduleResource::class;

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        $record = DutySchedule::updateOrCreate(
            ['duty_date' => $data['duty_date']],
            [
                'manager_id' => $data['manager_id'],
                'is_current' => (bool)($data['is_current'] ?? false),
            ],
        );

        if ($record->is_current) {
            DutySchedule::where('id', '<>', $record->id)->update(['is_current' => false]);
        }

        return $record;
    }
}
