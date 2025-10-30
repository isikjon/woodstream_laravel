@php
    $record = $getRecord();
    $images = [];
    
    if ($record) {
        $imagesData = $record->images;
        
        if ($imagesData) {
            if (is_array($imagesData)) {
                $images = $imagesData;
            } elseif (is_string($imagesData)) {
                $decoded = json_decode($imagesData, true);
                if (is_array($decoded)) {
                    $images = $decoded;
                }
            }
        }
        
        $images = array_map(function($img) {
            if (!str_starts_with($img, 'http')) {
                $img = 'https://woodstream.online' . $img;
            }
            $img = str_replace('woodstream.onlineimages', 'woodstream.online/images', $img);
            $img = str_replace('//', '/', $img);
            $img = str_replace('https:/', 'https://', $img);
            return $img;
        }, $images ?: []);
    }
@endphp

@if(!empty($images))
    <div class="rounded-lg border border-gray-300 dark:border-gray-700 p-4 bg-white dark:bg-gray-800">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($images as $index => $imageUrl)
                <div class="relative group" x-data="{ showDelete: false }">
                    <img 
                        src="{{ $imageUrl }}" 
                        alt="Изображение {{ $index + 1 }}" 
                        class="w-full h-32 object-cover rounded-lg shadow-md"
                        onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'100\' height=\'100\'%3E%3Crect fill=\'%23ddd\' width=\'100\' height=\'100\'/%3E%3Ctext fill=\'%23999\' x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\' font-size=\'12\'%3EОшибка%3C/text%3E%3C/svg%3E'"
                    >
                    <button 
                        type="button"
                        @click="deleteImage('{{ $imageUrl }}')"
                        class="absolute top-2 right-2 bg-red-600 hover:bg-red-700 text-white rounded-full p-2 shadow-lg transition-all duration-200 opacity-0 group-hover:opacity-100"
                        title="Удалить изображение"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            @endforeach
        </div>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
            Всего изображений: {{ count($images) }}
        </p>
    </div>

    <script>
        function deleteImage(imageUrl) {
            if (!confirm('Вы уверены, что хотите удалить это изображение?')) {
                return;
            }

            const imagesInput = document.querySelector('[name="images"]');
            const deleteInput = document.querySelector('[name="images_to_delete"]');
            
            if (imagesInput) {
                let currentImages = [];
                try {
                    currentImages = JSON.parse(imagesInput.value || '[]');
                } catch (e) {
                    console.error('Error parsing images:', e);
                }
                
                const originalUrl = imageUrl
                    .replace('https://woodstream.online', '')
                    .replace('https:/', '');
                
                currentImages = currentImages.filter(img => {
                    const normalizedImg = img.replace('https://woodstream.online', '').replace('https:/', '');
                    return normalizedImg !== originalUrl;
                });
                
                imagesInput.value = JSON.stringify(currentImages);
                imagesInput.dispatchEvent(new Event('input', { bubbles: true }));
            }
            
            if (deleteInput) {
                let toDelete = [];
                try {
                    toDelete = JSON.parse(deleteInput.value || '[]');
                } catch (e) {
                    toDelete = [];
                }
                toDelete.push(imageUrl);
                deleteInput.value = JSON.stringify(toDelete);
            }
            
            window.location.reload();
        }
    </script>
@endif

