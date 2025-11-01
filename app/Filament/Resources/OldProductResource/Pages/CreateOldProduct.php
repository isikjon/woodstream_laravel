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
            $path = $data['avatar_upload'];
            if (is_string($path)) {
                $fullPath = public_path($path);
                if (file_exists($fullPath)) {
                    $watermarkService->applyWatermark($fullPath);
                }
                $cleanPath = str_replace('\\', '/', $path);
                $data['avatar'] = '/' . $cleanPath;
            }
            unset($data['avatar_upload']);
        }

        if (isset($data['gallery_upload']) && is_array($data['gallery_upload']) && count($data['gallery_upload']) > 0) {
            $newImages = array_map(function($path) use ($watermarkService) {
                $fullPath = public_path($path);
                if (file_exists($fullPath)) {
                    $watermarkService->applyWatermark($fullPath);
                }
                $cleanPath = str_replace('\\', '/', $path);
                return '/' . $cleanPath;
            }, $data['gallery_upload']);

            $data['images'] = json_encode($newImages);
            unset($data['gallery_upload']);
        }

        return $data;
    }
}
