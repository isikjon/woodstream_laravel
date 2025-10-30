<?php

namespace App\Filament\Resources\BookingManagerResource\Pages;

use App\Filament\Resources\BookingManagerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookingManager extends EditRecord
{
    protected static string $resource = BookingManagerResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

