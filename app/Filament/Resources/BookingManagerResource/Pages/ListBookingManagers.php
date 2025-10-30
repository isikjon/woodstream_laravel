<?php

namespace App\Filament\Resources\BookingManagerResource\Pages;

use App\Filament\Resources\BookingManagerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBookingManagers extends ListRecords
{
    protected static string $resource = BookingManagerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Добавить менеджера'),
        ];
    }
}

