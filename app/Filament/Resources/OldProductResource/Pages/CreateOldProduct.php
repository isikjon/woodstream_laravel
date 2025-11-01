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
        $watermarkService = app(WatermarkService::class);

        if (isset($data['avatar_upload']) && $data['avatar_upload']) {
            $tempPath = $data['avatar_upload'];
            if (is_string($tempPath)) {
                $disk = \Storage::disk(config('livewire.temporary_file_upload.disk') ?: 'local');
                
                if ($disk->exists($tempPath)) {
                    $filename = uniqid() . '.png';
                    $finalPath = public_path('images/uploads/' . $filename);
                    
                    $tempFullPath = $disk->path($tempPath);
                    copy($tempFullPath, $finalPath);
                    
                    $watermarkService->applyWatermark($finalPath);
                    
                    $data['avatar'] = '/images/uploads/' . $filename;
                    $disk->delete($tempPath);
                }
            }
            unset($data['avatar_upload']);
        }

        if (isset($data['gallery_upload']) && is_array($data['gallery_upload']) && count($data['gallery_upload']) > 0) {
            $newImages = [];
            $disk = \Storage::disk(config('livewire.temporary_file_upload.disk') ?: 'local');
            
            foreach ($data['gallery_upload'] as $tempPath) {
                if ($disk->exists($tempPath)) {
                    $filename = uniqid() . '.png';
                    $finalPath = public_path('images/uploads/' . $filename);
                    
                    $tempFullPath = $disk->path($tempPath);
                    copy($tempFullPath, $finalPath);
                    
                    $watermarkService->applyWatermark($finalPath);
                    
                    $newImages[] = '/images/uploads/' . $filename;
                    $disk->delete($tempPath);
                }
            }
            
            $data['images'] = json_encode($newImages);
            unset($data['gallery_upload']);
        } else {
            if (empty($data['images'])) {
                $data['images'] = '[]';
            }
        }

        return $data;
    }
}
