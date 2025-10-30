<?php

namespace App\Observers;

use App\Models\OldProduct;
use App\Services\WatermarkService;
use Illuminate\Support\Facades\Storage;

class ProductImageObserver
{
    protected $watermarkService;

    public function __construct(WatermarkService $watermarkService)
    {
        $this->watermarkService = $watermarkService;
    }

    public function saving(OldProduct $product)
    {
        if ($product->isDirty('avatar') && $product->avatar) {
            $this->applyWatermarkToImage($product->avatar);
        }

        if ($product->isDirty('images') && $product->images) {
            $images = is_string($product->images) ? json_decode($product->images, true) : $product->images;
            
            if (is_array($images)) {
                foreach ($images as $image) {
                    if ($image) {
                        $this->applyWatermarkToImage($image);
                    }
                }
            }
        }
    }

    protected function applyWatermarkToImage(string $imagePath)
    {
        if (strpos($imagePath, 'http') === 0) {
            return;
        }

        $fullPath = public_path($imagePath);
        
        if (!file_exists($fullPath)) {
            $fullPath = storage_path('app/public/' . $imagePath);
        }

        if (file_exists($fullPath)) {
            $this->watermarkService->applyWatermark($fullPath);
        }
    }
}

