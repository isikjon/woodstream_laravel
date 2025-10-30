<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OldProduct;
use App\Services\WatermarkService;

class ApplyWatermarkToProducts extends Command
{
    protected $signature = 'watermark:apply {--product-id= : Apply to specific product} {--force : Force reapply to all images}';
    protected $description = 'Apply watermark to product images';

    protected $watermarkService;

    public function __construct(WatermarkService $watermarkService)
    {
        parent::__construct();
        $this->watermarkService = $watermarkService;
    }

    public function handle()
    {
        $productId = $this->option('product-id');
        
        if ($productId) {
            $products = OldProduct::where('id', $productId)->get();
            if ($products->isEmpty()) {
                $this->error("Product with ID {$productId} not found.");
                return 1;
            }
        } else {
            $products = OldProduct::whereNotNull('avatar')
                ->orWhereNotNull('images')
                ->get();
        }

        $this->info("Processing {$products->count()} products...");
        $bar = $this->output->createProgressBar($products->count());
        $bar->start();

        $processed = 0;
        $failed = 0;

        foreach ($products as $product) {
            try {
                if ($product->avatar) {
                    $imagePath = $this->getImagePath($product->avatar);
                    if ($imagePath && file_exists($imagePath)) {
                        if ($this->watermarkService->applyWatermark($imagePath)) {
                            $processed++;
                        } else {
                            $failed++;
                        }
                    }
                }

                if ($product->images) {
                    $images = is_string($product->images) ? json_decode($product->images, true) : $product->images;
                    if (is_array($images)) {
                        foreach ($images as $image) {
                            $imagePath = $this->getImagePath($image);
                            if ($imagePath && file_exists($imagePath)) {
                                if ($this->watermarkService->applyWatermark($imagePath)) {
                                    $processed++;
                                } else {
                                    $failed++;
                                }
                            }
                        }
                    }
                }
            } catch (\Exception $e) {
                $this->error("\nError processing product {$product->id}: " . $e->getMessage());
                $failed++;
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("Processed: {$processed} images");
        if ($failed > 0) {
            $this->warn("Failed: {$failed} images");
        }
        $this->info('Done!');

        return 0;
    }

    protected function getImagePath($imagePath)
    {
        if (strpos($imagePath, 'http') === 0) {
            return null;
        }

        $fullPath = public_path($imagePath);
        if (file_exists($fullPath)) {
            return $fullPath;
        }

        $fullPath = storage_path('app/public/' . $imagePath);
        if (file_exists($fullPath)) {
            return $fullPath;
        }

        return null;
    }
}

