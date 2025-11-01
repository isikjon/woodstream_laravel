@php
    $record = $getRecord();
    $imageUrl = $record ? $record->image_url : null;
@endphp

@if($imageUrl)
<div class="w-full">
    <div class="relative w-full rounded-lg overflow-hidden shadow-lg" style="max-width: 100%;">
        <a href="{{ $imageUrl }}" 
           target="_blank" 
           class="review-lightbox-trigger block cursor-pointer hover:opacity-90 transition-opacity"
           onclick="openReviewLightbox(event, '{{ $imageUrl }}', '{{ addslashes($record->name ?? '') }}')">
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

<!-- Lightbox Modal -->
<div id="review-lightbox" class="review-lightbox" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.95); z-index: 9999; justify-content: center; align-items: center; cursor: pointer;" onclick="closeReviewLightbox()">
    <div style="position: relative; max-width: 95%; max-height: 95vh;">
        <button onclick="closeReviewLightbox()" style="position: absolute; top: -40px; right: 0; background: white; border: none; border-radius: 50%; width: 36px; height: 36px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: bold; box-shadow: 0 2px 10px rgba(0,0,0,0.3);">
            ×
        </button>
        <img id="review-lightbox-img" src="" alt="" style="max-width: 100%; max-height: 95vh; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.5);">
    </div>
</div>

<script>
function openReviewLightbox(event, imageUrl, imageName) {
    event.preventDefault();
    const lightbox = document.getElementById('review-lightbox');
    const img = document.getElementById('review-lightbox-img');
    img.src = imageUrl;
    img.alt = imageName;
    lightbox.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeReviewLightbox() {
    const lightbox = document.getElementById('review-lightbox');
    lightbox.style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Close on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeReviewLightbox();
    }
});
</script>
@endif

