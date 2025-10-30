@php
    $record = $getRecord();
    $avatarUrl = $record ? $record->avatar : null;
    
    if ($avatarUrl) {
        if (!str_starts_with($avatarUrl, 'http')) {
            $avatarUrl = 'https://woodstream.online' . $avatarUrl;
        }
        $avatarUrl = str_replace('img/products/', '/img/products/', $avatarUrl);
        $avatarUrl = str_replace('//', '/', $avatarUrl);
        $avatarUrl = str_replace('https:/', 'https://', $avatarUrl);
        $avatarUrl = str_replace('woodstream.onlineimages', 'woodstream.online/images', $avatarUrl);
    }
@endphp

@if($avatarUrl)
    <div class="rounded-lg border border-gray-300 dark:border-gray-700 p-4 bg-white dark:bg-gray-800">
        <img 
            src="{{ $avatarUrl }}" 
            alt="Главное изображение" 
            class="max-w-full h-auto rounded-lg shadow-md"
            style="max-height: 400px; object-fit: contain;"
            onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'200\' height=\'200\'%3E%3Crect fill=\'%23ddd\' width=\'200\' height=\'200\'/%3E%3Ctext fill=\'%23999\' x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\'%3EОшибка загрузки%3C/text%3E%3C/svg%3E'"
        >
    </div>
@endif

