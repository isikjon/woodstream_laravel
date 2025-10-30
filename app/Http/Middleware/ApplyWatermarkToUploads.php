<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\WatermarkService;
use Symfony\Component\HttpFoundation\Response;

class ApplyWatermarkToUploads
{
    protected $watermarkService;

    public function __construct(WatermarkService $watermarkService)
    {
        $this->watermarkService = $watermarkService;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->hasFile('avatar_upload') || $request->hasFile('gallery_upload')) {
            $files = [];
            
            if ($request->hasFile('avatar_upload')) {
                $files[] = $request->file('avatar_upload');
            }
            
            if ($request->hasFile('gallery_upload')) {
                $uploadedFiles = $request->file('gallery_upload');
                $files = array_merge($files, is_array($uploadedFiles) ? $uploadedFiles : [$uploadedFiles]);
            }

            foreach ($files as $file) {
                if ($file && $file->isValid()) {
                    $path = $file->getRealPath();
                    if (in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/gif', 'image/webp'])) {
                        $this->watermarkService->applyWatermark($path);
                    }
                }
            }
        }

        return $response;
    }
}

