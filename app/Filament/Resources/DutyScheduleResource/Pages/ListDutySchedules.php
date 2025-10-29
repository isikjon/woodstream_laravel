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
use Illuminate\Database\Eloquent\Builder;

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

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->where('duty_date', '>=', now()->toDateString())
            ->orderBy('duty_date', 'asc')
            ->limit(4);
    }

    protected function paginateTableQuery(Builder $query): \Illuminate\Contracts\Pagination\Paginator
    {
        return $query->simplePaginate(4);
    }
}
