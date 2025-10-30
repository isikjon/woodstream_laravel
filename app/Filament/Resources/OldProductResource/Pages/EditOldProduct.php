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
        \Log::info('=== НАЧАЛО mutateFormDataBeforeSave ===');
        \Log::info('Incoming data[images]:', ['images' => $data['images'] ?? 'НЕ УСТАНОВЛЕНО']);
        \Log::info('Incoming data[images_to_delete]:', ['images_to_delete' => $data['images_to_delete'] ?? 'НЕ УСТАНОВЛЕНО']);
        
        if (isset($data['delete_avatar']) && $data['delete_avatar'] == '1') {
            $data['avatar'] = null;
        }
        
        if (isset($data['avatar_upload']) && $data['avatar_upload']) {
            $path = $data['avatar_upload'];
            if (is_string($path)) {
                $cleanPath = str_replace('\\', '/', $path);
                $data['avatar'] = '/storage/' . $cleanPath;
            }
        }
        
        unset($data['avatar_upload'], $data['delete_avatar']);

        $currentImages = [];
        if (!empty($data['images'])) {
            $currentImages = is_array($data['images']) ? $data['images'] : (json_decode($data['images'], true) ?: []);
        }
        
        \Log::info('Current images после парсинга:', ['count' => count($currentImages), 'images' => $currentImages]);

        $currentImages = array_map(function($img) {
            $img = str_replace('\\', '/', $img);
            $img = str_replace('https://woodstream.online', '', $img);
            $img = str_replace('http://localhost', '', $img);
            $img = str_replace('https://', '', $img);
            $img = str_replace('http://', '', $img);
            $img = preg_replace('#/+#', '/', $img);
            if (!str_starts_with($img, '/')) {
                $img = '/' . $img;
            }
            return $img;
        }, $currentImages);

        if (isset($data['images_to_delete'])) {
            $toDelete = json_decode($data['images_to_delete'], true) ?: [];
            \Log::info('Images to delete:', ['count' => count($toDelete), 'toDelete' => $toDelete]);
            
            if (!empty($toDelete)) {
                $toDelete = array_map(function($url) {
                    $url = str_replace('\\', '/', $url);
                    $url = str_replace('https://woodstream.online', '', $url);
                    $url = str_replace('http://localhost', '', $url);
                    $url = str_replace('https://', '', $url);
                    $url = str_replace('http://', '', $url);
                    $url = preg_replace('#/+#', '/', $url);
                    if (!str_starts_with($url, '/')) {
                        $url = '/' . $url;
                    }
                    return $url;
                }, $toDelete);
                
                \Log::info('Images to delete (normalized):', ['toDelete' => $toDelete]);
                
                $beforeDelete = count($currentImages);
                $currentImages = array_filter($currentImages, function($img) use ($toDelete) {
                    $shouldKeep = !in_array($img, $toDelete);
                    if (!$shouldKeep) {
                        \Log::info('УДАЛЯЕМ фото:', ['img' => $img]);
                    }
                    return $shouldKeep;
                });
                $currentImages = array_values($currentImages);
                $afterDelete = count($currentImages);
                
                \Log::info('Результат удаления:', ['было' => $beforeDelete, 'стало' => $afterDelete, 'удалено' => ($beforeDelete - $afterDelete)]);
            }
            unset($data['images_to_delete']);
        }

        if (isset($data['gallery_upload']) && is_array($data['gallery_upload']) && count($data['gallery_upload']) > 0) {
            $newImages = array_map(function($path) {
                $cleanPath = str_replace('\\', '/', $path);
                return '/storage/' . $cleanPath;
            }, $data['gallery_upload']);

            $currentImages = array_merge($currentImages, $newImages);
            unset($data['gallery_upload']);
        }

        $currentImages = array_unique($currentImages);
        $currentImages = array_values($currentImages);

        $data['images'] = json_encode($currentImages);
        
        \Log::info('ИТОГОВЫЙ data[images] для сохранения:', ['images' => $data['images']]);
        \Log::info('=== КОНЕЦ mutateFormDataBeforeSave ===');

        return $data;
    }
}
