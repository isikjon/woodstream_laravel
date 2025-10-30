<?php

namespace App\Filament\Concerns;

use App\Services\WatermarkService;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

trait HasWatermark
{
    protected function applyWatermarkToUpload($file)
    {
        if (!$file instanceof TemporaryUploadedFile) {
            return $file;
        }

        $path = $file->getRealPath();
        
        if (file_exists($path)) {
            $watermarkService = app(WatermarkService::class);
            $watermarkService->applyWatermark($path);
        }

        return $file;
    }

    protected function processUploadedImage($file)
    {
        return $this->applyWatermarkToUpload($file);
    }
}

