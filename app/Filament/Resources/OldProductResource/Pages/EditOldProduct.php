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

        $currentImages = [];
        if (!empty($data['images'])) {
            $currentImages = is_array($data['images']) ? $data['images'] : json_decode($data['images'], true) ?: [];
        }

        if (isset($data['images_to_delete'])) {
            $toDelete = json_decode($data['images_to_delete'], true) ?: [];
            if (!empty($toDelete)) {
                $currentImages = array_filter($currentImages, function($img) use ($toDelete) {
                    $normalizedImg = str_replace('https://woodstream.online', '', $img);
                    $normalizedImg = str_replace('https:/', '', $normalizedImg);
                    
                    foreach ($toDelete as $deleteUrl) {
                        $normalizedDelete = str_replace('https://woodstream.online', '', $deleteUrl);
                        $normalizedDelete = str_replace('https:/', '', $normalizedDelete);
                        if ($normalizedImg === $normalizedDelete) {
                            return false;
                        }
                    }
                    return true;
                });
                $currentImages = array_values($currentImages);
            }
            unset($data['images_to_delete']);
        }

        if (isset($data['gallery_upload']) && is_array($data['gallery_upload']) && count($data['gallery_upload']) > 0) {
            $newImages = array_map(function($path) {
                return Storage::disk('public')->url($path);
            }, $data['gallery_upload']);

            $currentImages = array_merge($currentImages, $newImages);
            unset($data['gallery_upload']);
        }

        $data['images'] = json_encode($currentImages);

        return $data;
    }
}
