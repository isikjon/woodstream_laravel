<?php

namespace App\Filament\Resources\OldProductResource\Pages;

use App\Filament\Resources\OldProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOldProducts extends ListRecords
{
    protected static string $resource = OldProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
