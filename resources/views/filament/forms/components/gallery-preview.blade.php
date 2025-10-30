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
            @foreach($images as $imageUrl)
                <div class="relative group">
                    <img 
                        src="{{ $imageUrl }}" 
                        alt="Изображение галереи" 
                        class="w-full h-32 object-cover rounded-lg shadow-md cursor-pointer hover:opacity-75 transition-opacity"
                        onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'100\' height=\'100\'%3E%3Crect fill=\'%23ddd\' width=\'100\' height=\'100\'/%3E%3Ctext fill=\'%23999\' x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\' font-size=\'12\'%3EОшибка%3C/text%3E%3C/svg%3E'"
                        onclick="window.open('{{ $imageUrl }}', '_blank')"
                    >
                </div>
            @endforeach
        </div>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
            Всего изображений: {{ count($images) }}
        </p>
    </div>
@endif

