<?php

namespace App\Filament\Resources\PopupResource\Pages;

use App\Filament\Resources\PopupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPopup extends EditRecord
{
    protected static string $resource = PopupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->hidden(fn () => $this->record->is_fixed),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (!empty($data['image']) && str_starts_with($data['image'], 'https://dev.woodstream.online/storage/')) {
            $data['image'] = str_replace('https://dev.woodstream.online/storage/', '', $data['image']);
        } elseif (!empty($data['image']) && str_starts_with($data['image'], '/storage/')) {
            $data['image'] = str_replace('/storage/', '', $data['image']);
        }
        
        if (!empty($data['image_mobile']) && str_starts_with($data['image_mobile'], 'https://dev.woodstream.online/storage/')) {
            $data['image_mobile'] = str_replace('https://dev.woodstream.online/storage/', '', $data['image_mobile']);
        } elseif (!empty($data['image_mobile']) && str_starts_with($data['image_mobile'], '/storage/')) {
            $data['image_mobile'] = str_replace('/storage/', '', $data['image_mobile']);
        }
        
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['content'] = $data['content'] ?? '';
        
        if (!empty($data['image']) && !str_starts_with($data['image'], 'http')) {
            $data['image'] = 'https://dev.woodstream.online/storage/' . $data['image'];
        }
        if (!empty($data['image_mobile']) && !str_starts_with($data['image_mobile'], 'http')) {
            $data['image_mobile'] = 'https://dev.woodstream.online/storage/' . $data['image_mobile'];
        }
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

