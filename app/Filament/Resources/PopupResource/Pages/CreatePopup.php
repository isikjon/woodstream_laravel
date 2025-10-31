<?php

namespace App\Filament\Resources\PopupResource\Pages;

use App\Filament\Resources\PopupResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePopup extends CreateRecord
{
    protected static string $resource = PopupResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (!empty($data['image']) && !str_starts_with($data['image'], 'http')) {
            $data['image'] = '/storage/' . $data['image'];
        }
        if (!empty($data['image_mobile']) && !str_starts_with($data['image_mobile'], 'http')) {
            $data['image_mobile'] = '/storage/' . $data['image_mobile'];
        }
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

