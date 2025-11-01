<?php

namespace App\Filament\Resources\OldProductResource\Pages;

use App\Filament\Resources\OldProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Services\WatermarkService;

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
                $fullPath = public_path($tempPath);
                \Log::info('Avatar: Checking file', ['path' => $tempPath, 'fullPath' => $fullPath, 'exists' => file_exists($fullPath)]);
                
                if (file_exists($fullPath)) {
                    $watermarkService->applyWatermark($fullPath);
                    $data['avatar'] = '/' . $tempPath;
                    \Log::info('Avatar: Watermark applied', ['avatar' => $data['avatar']]);
                } else {
                    \Log::error('Avatar: File not found', ['path' => $fullPath]);
                }
            }
            unset($data['avatar_upload']);
        }

        if (isset($data['gallery_upload']) && is_array($data['gallery_upload']) && count($data['gallery_upload']) > 0) {
            $newImages = [];
            
            foreach ($data['gallery_upload'] as $tempPath) {
                $fullPath = public_path($tempPath);
                \Log::info('Gallery: Checking file', ['path' => $tempPath, 'fullPath' => $fullPath, 'exists' => file_exists($fullPath)]);
                
                if (file_exists($fullPath)) {
                    $watermarkService->applyWatermark($fullPath);
                    $newImages[] = '/' . $tempPath;
                    \Log::info('Gallery: Watermark applied', ['image' => '/' . $tempPath]);
                } else {
                    \Log::error('Gallery: File not found', ['path' => $fullPath]);
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
