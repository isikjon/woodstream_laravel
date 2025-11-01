<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class WatermarkService
{
    protected $watermarkPath;
    protected $watermarkOpacity;
    protected $watermarkPosition;
    protected $watermarkScale;

    public function __construct()
    {
        $this->watermarkPath = public_path('images/watermark.svg');
        $this->watermarkOpacity = 30;
        $this->watermarkPosition = 'center';
        $this->watermarkScale = 1.0;
    }

    public function applyWatermark(string $imagePath): bool
    {
        try {
            if (!file_exists($imagePath)) {
                \Log::error('Image file not found: ' . $imagePath);
                return false;
            }

            if (!file_exists($this->watermarkPath)) {
                \Log::error('Watermark file not found: ' . $this->watermarkPath);
                return false;
            }

            $imageInfo = getimagesize($imagePath);
            if (!$imageInfo) {
                \Log::error('Unable to get image info: ' . $imagePath);
                return false;
            }

            $imageWidth = $imageInfo[0];
            $imageHeight = $imageInfo[1];
            $imageType = $imageInfo[2];

            $image = $this->loadImage($imagePath, $imageType);
            if (!$image) {
                return false;
            }

            $watermarkWidth = (int)($imageWidth * $this->watermarkScale);
            $watermarkHeight = (int)($watermarkWidth * 0.25);

            $watermark = $this->createWatermarkFromSvg($watermarkWidth, $watermarkHeight);
            if (!$watermark) {
                imagedestroy($image);
                return false;
            }

            $position = $this->calculatePosition($imageWidth, $imageHeight, $watermarkWidth, $watermarkHeight);

            imagecopymerge(
                $image,
                $watermark,
                $position['x'],
                $position['y'],
                0,
                0,
                $watermarkWidth,
                $watermarkHeight,
                $this->watermarkOpacity
            );

            $this->saveImage($image, $imagePath, $imageType);

            imagedestroy($image);
            imagedestroy($watermark);

            return true;
        } catch (\Exception $e) {
            \Log::error('Watermark application failed: ' . $e->getMessage());
            return false;
        }
    }

    protected function loadImage($path, $type)
    {
        switch ($type) {
            case IMAGETYPE_JPEG:
                return imagecreatefromjpeg($path);
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($path);
                imagealphablending($image, true);
                imagesavealpha($image, true);
                return $image;
            case IMAGETYPE_GIF:
                return imagecreatefromgif($path);
            case IMAGETYPE_WEBP:
                return imagecreatefromwebp($path);
            default:
                return false;
        }
    }

    protected function saveImage($image, $path, $type, $quality = 90)
    {
        switch ($type) {
            case IMAGETYPE_JPEG:
                imagejpeg($image, $path, $quality);
                break;
            case IMAGETYPE_PNG:
                imagepng($image, $path, (int)(9 - ($quality / 10)));
                break;
            case IMAGETYPE_GIF:
                imagegif($image, $path);
                break;
            case IMAGETYPE_WEBP:
                imagewebp($image, $path, $quality);
                break;
        }
    }

    protected function createWatermarkFromSvg($width, $height)
    {
        $svgContent = file_get_contents($this->watermarkPath);
        
        $tempPngPath = sys_get_temp_dir() . '/watermark_' . uniqid() . '.png';
        
        if (extension_loaded('imagick')) {
            $imagick = new \Imagick();
            $imagick->readImageBlob($svgContent);
            $imagick->setImageFormat('png');
            $imagick->resizeImage($width, $height, \Imagick::FILTER_LANCZOS, 1);
            $imagick->writeImage($tempPngPath);
            $imagick->clear();
            $imagick->destroy();
            
            $watermark = imagecreatefrompng($tempPngPath);
            unlink($tempPngPath);
            
            return $watermark;
        } else {
            $watermark = imagecreatetruecolor($width, $height);
            imagesavealpha($watermark, true);
            $transparent = imagecolorallocatealpha($watermark, 0, 0, 0, 127);
            imagefill($watermark, 0, 0, $transparent);
            
            $white = imagecolorallocate($watermark, 255, 255, 255);
            $fontSize = (int)($height * 0.15);
            
            $text = 'WOODSTREAM';
            $font = public_path('fonts/DejaVuSans.ttf');
            
            if (!file_exists($font)) {
                $x = (int)(($width - strlen($text) * $fontSize * 0.6) / 2);
                $y = (int)($height / 2 + $fontSize / 2);
                imagestring($watermark, 5, $x, $y, $text, $white);
            } else {
                $bbox = imagettfbbox($fontSize, 0, $font, $text);
                $textWidth = abs($bbox[4] - $bbox[0]);
                $textHeight = abs($bbox[5] - $bbox[1]);
                
                $x = (int)(($width - $textWidth) / 2);
                $y = (int)(($height + $textHeight) / 2);
                
                imagettftext($watermark, $fontSize, 0, $x, $y, $white, $font, $text);
            }
            
            return $watermark;
        }
    }

    protected function calculatePosition($imageWidth, $imageHeight, $watermarkWidth, $watermarkHeight)
    {
        switch ($this->watermarkPosition) {
            case 'top-left':
                return ['x' => 10, 'y' => 10];
            case 'top-right':
                return ['x' => $imageWidth - $watermarkWidth - 10, 'y' => 10];
            case 'bottom-left':
                return ['x' => 10, 'y' => $imageHeight - $watermarkHeight - 10];
            case 'bottom-right':
                return ['x' => $imageWidth - $watermarkWidth - 10, 'y' => $imageHeight - $watermarkHeight - 10];
            case 'center':
            default:
                return [
                    'x' => (int)(($imageWidth - $watermarkWidth) / 2),
                    'y' => (int)(($imageHeight - $watermarkHeight) / 2)
                ];
        }
    }

    public function setOpacity(int $opacity)
    {
        $this->watermarkOpacity = max(0, min(100, $opacity));
        return $this;
    }

    public function setPosition(string $position)
    {
        $this->watermarkPosition = $position;
        return $this;
    }

    public function setScale(float $scale)
    {
        $this->watermarkScale = max(0.1, min(1.0, $scale));
        return $this;
    }
}

