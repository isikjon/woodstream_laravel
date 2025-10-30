<?php

namespace App\Filament\Resources\OldProductResource\Pages;

use App\Filament\Resources\OldProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditOldProduct extends EditRecord
{
    protected static string $resource = OldProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['avatar_upload']) && $data['avatar_upload']) {
            $data['avatar'] = Storage::disk('public')->url($data['avatar_upload']);
            unset($data['avatar_upload']);
        }

        if (isset($data['gallery_upload']) && is_array($data['gallery_upload']) && count($data['gallery_upload']) > 0) {
            $existingImages = [];
            if (!empty($data['images'])) {
                $existingImages = is_array($data['images']) ? $data['images'] : json_decode($data['images'], true) ?: [];
            }

            $newImages = array_map(function($path) {
                return Storage::disk('public')->url($path);
            }, $data['gallery_upload']);

            $allImages = array_merge($existingImages, $newImages);
            $data['images'] = json_encode($allImages);
            unset($data['gallery_upload']);
        }

        return $data;
    }
}
