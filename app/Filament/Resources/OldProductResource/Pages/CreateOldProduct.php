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
        
        // Логируем конфигурацию Livewire
        \Log::info('Livewire config:', [
            'disk' => config('livewire.temporary_file_upload.disk'),
            'directory' => config('livewire.temporary_file_upload.directory')
        ]);
        
        $watermarkService = app(WatermarkService::class);

        if (isset($data['avatar_upload']) && $data['avatar_upload']) {
            $tempPath = $data['avatar_upload'];
            \Log::info('Avatar: Processing', ['type' => gettype($tempPath), 'value' => $tempPath]);
            
            if (is_string($tempPath)) {
                // Пробуем оба диска с папкой livewire-tmp
                $disksToTry = ['public', 'local'];
                $found = false;
                
                foreach ($disksToTry as $diskName) {
                    $disk = \Storage::disk($diskName);
                    
                    // Пробуем с папкой livewire-tmp и без
                    $pathsToTry = [
                        'livewire-tmp/' . $tempPath,
                        $tempPath
                    ];
                    
                    foreach ($pathsToTry as $path) {
                        $fullPath = $disk->path($path);
                        $exists = $disk->exists($path);
                        
                        \Log::info("Avatar: Checking disk '$diskName' with path", [
                            'path' => $path,
                            'full_path' => $fullPath,
                            'exists' => $exists,
                            'is_file' => file_exists($fullPath)
                        ]);
                    
                        if ($exists) {
                            $found = true;
                            \Log::info("Avatar: FOUND on disk '$diskName' at path '$path'!");
                            
                            $filename = uniqid() . '.png';
                            $finalPath = public_path('images/uploads/' . $filename);
                            
                            $tempFullPath = $disk->path($path);
                            \Log::info('Avatar: Copying', [
                                'from' => $tempFullPath,
                                'to' => $finalPath,
                                'source_exists' => file_exists($tempFullPath)
                            ]);
                            
                            copy($tempFullPath, $finalPath);
                            
                            \Log::info('Avatar: Applying watermark', ['path' => $finalPath]);
                            $watermarkService->applyWatermark($finalPath);
                            
                            $disk->delete($path);
                            
                            $data['avatar'] = '/images/uploads/' . $filename;
                            \Log::info('Avatar: SUCCESS!', ['avatar' => $data['avatar']]);
                            break 2; // Выходим из обоих циклов
                        }
                    }
                    
                    if ($found) break;
                }
                
                if (!$found) {
                    \Log::error('Avatar: NOT FOUND on any disk!');
                    
                    // Ищем файл везде
                    $searchPaths = [
                        storage_path('app/public/livewire-tmp/' . $tempPath),
                        storage_path('app/private/livewire-tmp/' . $tempPath),
                        storage_path('app/livewire-tmp/' . $tempPath),
                        storage_path('app/public/' . $tempPath),
                        storage_path('app/private/' . $tempPath),
                        storage_path('app/' . $tempPath),
                    ];
                    
                    foreach ($searchPaths as $searchPath) {
                        \Log::info('Avatar: Manual search', [
                            'path' => $searchPath,
                            'exists' => file_exists($searchPath)
                        ]);
                    }
                }
            }
            unset($data['avatar_upload']);
        }

        if (isset($data['gallery_upload']) && is_array($data['gallery_upload']) && count($data['gallery_upload']) > 0) {
            $newImages = [];
            \Log::info('Gallery: Processing', ['count' => count($data['gallery_upload'])]);
            
            foreach ($data['gallery_upload'] as $index => $tempPath) {
                \Log::info("Gallery[$index]: Processing", ['type' => gettype($tempPath), 'value' => $tempPath]);
                
                // Пробуем оба диска с папкой livewire-tmp
                $disksToTry = ['public', 'local'];
                $found = false;
                
                foreach ($disksToTry as $diskName) {
                    $disk = \Storage::disk($diskName);
                    
                    // Пробуем с папкой livewire-tmp и без
                    $pathsToTry = [
                        'livewire-tmp/' . $tempPath,
                        $tempPath
                    ];
                    
                    foreach ($pathsToTry as $path) {
                        $fullPath = $disk->path($path);
                        $exists = $disk->exists($path);
                        
                        \Log::info("Gallery[$index]: Checking disk '$diskName' with path", [
                            'path' => $path,
                            'full_path' => $fullPath,
                            'exists' => $exists,
                            'is_file' => file_exists($fullPath)
                        ]);
                        
                        if ($exists) {
                            $found = true;
                            \Log::info("Gallery[$index]: FOUND on disk '$diskName' at path '$path'!");
                            
                            $filename = uniqid() . '.png';
                            $finalPath = public_path('images/uploads/' . $filename);
                            
                            $tempFullPath = $disk->path($path);
                            copy($tempFullPath, $finalPath);
                            
                            $watermarkService->applyWatermark($finalPath);
                            $disk->delete($path);
                            
                            $newImages[] = '/images/uploads/' . $filename;
                            \Log::info("Gallery[$index]: SUCCESS!", ['image' => '/images/uploads/' . $filename]);
                            break 2; // Выходим из обоих циклов
                        }
                    }
                    
                    if ($found) break;
                }
                
                if (!$found) {
                    \Log::error("Gallery[$index]: NOT FOUND on any disk!");
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
