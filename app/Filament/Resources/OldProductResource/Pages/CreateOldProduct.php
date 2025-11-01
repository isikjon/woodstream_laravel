<?php

namespace App\Filament\Resources\OldProductResource\Pages;

use App\Filament\Resources\OldProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Services\WatermarkService;
use Illuminate\Support\Facades\Storage;

class CreateOldProduct extends CreateRecord
{
    protected static string $resource = OldProductResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        \Log::info('=== НАЧАЛО mutateFormDataBeforeCreate ===');
        \Log::info('Incoming data keys:', ['keys' => array_keys($data)]);
        \Log::info('avatar_upload:', ['avatar_upload' => $data['avatar_upload'] ?? 'НЕ УСТАНОВЛЕНО']);
        \Log::info('gallery_upload:', ['gallery_upload' => $data['gallery_upload'] ?? 'НЕ УСТАНОВЛЕНО']);
        
        $watermarkService = app(WatermarkService::class);

        if (isset($data['avatar_upload']) && $data['avatar_upload']) {
            $tempPath = $data['avatar_upload'];
            if (is_string($tempPath)) {
                $disk = \Storage::disk(config('livewire.temporary_file_upload.disk') ?: 'local');
                \Log::info('Avatar: Checking file', ['path' => $tempPath, 'disk' => $disk->path($tempPath), 'exists' => $disk->exists($tempPath)]);
                
                if ($disk->exists($tempPath)) {
                    $filename = uniqid() . '.png';
                    $finalPath = public_path('images/uploads/' . $filename);
                    
                    $tempFullPath = $disk->path($tempPath);
                    copy($tempFullPath, $finalPath);
                    
                    $watermarkService->applyWatermark($finalPath);
                    $disk->delete($tempPath);
                    
                    $data['avatar'] = '/images/uploads/' . $filename;
                    \Log::info('Avatar: Copied & watermarked', ['avatar' => $data['avatar']]);
                } else {
                    \Log::error('Avatar: File not found', ['disk_path' => $disk->path($tempPath)]);
                }
            }
            unset($data['avatar_upload']);
        }

        if (isset($data['gallery_upload']) && is_array($data['gallery_upload']) && count($data['gallery_upload']) > 0) {
            $disk = \Storage::disk(config('livewire.temporary_file_upload.disk') ?: 'local');
            $newImages = [];
            
            foreach ($data['gallery_upload'] as $tempPath) {
                \Log::info('Gallery: Checking file', ['path' => $tempPath, 'disk_path' => $disk->path($tempPath), 'exists' => $disk->exists($tempPath)]);
                
                if ($disk->exists($tempPath)) {
                    $filename = uniqid() . '.png';
                    $finalPath = public_path('images/uploads/' . $filename);
                    
                    $tempFullPath = $disk->path($tempPath);
                    copy($tempFullPath, $finalPath);
                    
                    $watermarkService->applyWatermark($finalPath);
                    $disk->delete($tempPath);
                    
                    $newImages[] = '/images/uploads/' . $filename;
                    \Log::info('Gallery: Copied & watermarked', ['image' => '/images/uploads/' . $filename]);
                } else {
                    \Log::error('Gallery: File not found', ['disk_path' => $disk->path($tempPath)]);
                }
            }
            
            $data['images'] = json_encode($newImages);
            unset($data['gallery_upload']);
        } else {
            if (empty($data['images'])) {
                $data['images'] = '[]';
            }
        }

        \Log::info('=== КОНЕЦ mutateFormDataBeforeCreate ===');
        \Log::info('Final avatar:', ['avatar' => $data['avatar'] ?? 'NULL']);
        \Log::info('Final images:', ['images' => $data['images'] ?? 'NULL']);
        
        return $data;
    }
}
