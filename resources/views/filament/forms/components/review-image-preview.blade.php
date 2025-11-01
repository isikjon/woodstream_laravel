@php
    $record = $getRecord();
    $imageUrl = $record ? $record->image_url : null;
@endphp

@push('styles')
<link rel="stylesheet" href="{{ asset('css/fancybox.css') }}">
@endpush

@if($imageUrl)
<div class="w-full">
    <div class="relative w-full rounded-lg overflow-hidden shadow-lg" style="max-width: 100%;">
        <a href="{{ $imageUrl }}" 
           data-fancybox="review-gallery"
           data-caption="{{ $record->name ?? 'Review image' }}"
           class="block cursor-pointer hover:opacity-90 transition-opacity">
            <img src="{{ $imageUrl }}" 
                 alt="{{ $record->name ?? 'Review image' }}" 
                 class="w-full h-auto object-contain"
                 style="max-height: 100%; max-width: 300px; border-radius: 10px;">
            <div class="absolute top-2 right-2 bg-white/90 dark:bg-gray-800/90 rounded-full p-2 shadow-lg">
                <svg class="w-5 h-5 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                </svg>
            </div>
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-4">
                <p class="text-white text-sm font-medium">
                    {{ $record->name }}
                </p>
                <p class="text-white/80 text-xs mt-1">
                    URL: {{ $imageUrl }}
                </p>
                <p class="text-white/60 text-xs mt-1 italic">
                    Нажмите чтобы увеличить
                </p>
            </div>
        </a>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/fancybox.umd.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof Fancybox !== 'undefined') {
        Fancybox.bind('[data-fancybox="review-gallery"]', {
            Toolbar: {
                display: {
                    left: [],
                    middle: [],
                    right: ["close"],
                },
            },
        });
    }
});
</script>
@endpush
@endif

