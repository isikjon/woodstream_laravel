@php
    $record = $getRecord();
    $imageUrl = $record ? $record->image_url : null;
@endphp

@if($imageUrl)
<div class="w-full">
    <div class="relative w-full rounded-lg overflow-hidden shadow-lg" style="max-width: 100%;">
        <img src="{{ $imageUrl }}" 
             alt="{{ $record->name ?? 'Review image' }}" 
             class="w-full h-auto object-contain"
             style="max-height: 100%; max-width: 300px; border-radius: 10px;">
        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-4">
            <p class="text-white text-sm font-medium">
                {{ $record->name }}
            </p>
            <p class="text-white/80 text-xs mt-1">
                URL: {{ $imageUrl }}
            </p>
        </div>
    </div>
</div>
@endif

