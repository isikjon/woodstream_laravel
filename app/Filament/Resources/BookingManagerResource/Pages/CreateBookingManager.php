<?php

namespace App\Filament\Resources\BookingManagerResource\Pages;

use App\Filament\Resources\BookingManagerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBookingManager extends CreateRecord
{
    protected static string $resource = BookingManagerResource::class;
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

