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
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="gallery-grid-{{ $getRecord()->id }}">
            @foreach($images as $index => $imageUrl)
                <div class="flex flex-col" data-image-url="{{ $imageUrl }}">
                    <img 
                        src="{{ $imageUrl }}" 
                        alt="Изображение {{ $index + 1 }}" 
                        class="w-full h-32 object-cover rounded-lg shadow-md mb-2"
                        onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'100\' height=\'100\'%3E%3Crect fill=\'%23ddd\' width=\'100\' height=\'100\'/%3E%3Ctext fill=\'%23999\' x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\' font-size=\'12\'%3EОшибка%3C/text%3E%3C/svg%3E'"
                    >
                    <div class="flex gap-2 justify-center">
                        <a 
                            href="javascript:void(0)" 
                            onclick="setAsMainImage{{ $getRecord()->id }}('{{ $imageUrl }}')"
                            class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300 text-sm font-medium underline cursor-pointer"
                        >
                            Сделать главным
                        </a>
                        <span class="text-gray-400">|</span>
                        <a 
                            href="javascript:void(0)" 
                            onclick="deleteGalleryImage{{ $getRecord()->id }}('{{ $imageUrl }}')"
                            class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 text-sm font-medium underline cursor-pointer"
                        >
                            Удалить
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-4">
            Всего изображений: {{ count($images) }}
        </p>
    </div>

    <script>
        window.setAsMainImage{{ $getRecord()->id }} = function(imageUrl) {
            if (!confirm('Сделать это изображение главным?')) {
                return;
            }

            const normalizedUrl = imageUrl
                .replace('https://woodstream.online', '')
                .replace('https:/', '')
                .replace(/\/\//g, '/');

            const avatarInput = document.querySelector('input[name="avatar"]');
            if (avatarInput) {
                avatarInput.value = normalizedUrl;
                
                const changeEvent = new Event('change', { bubbles: true });
                avatarInput.dispatchEvent(changeEvent);
                
                const inputEvent = new Event('input', { bubbles: true });
                avatarInput.dispatchEvent(inputEvent);
                
                try {
                    const wireId = avatarInput.closest('[wire\\:id]')?.getAttribute('wire:id');
                    if (wireId && window.Livewire) {
                        const component = window.Livewire.find(wireId);
                        if (component) {
                            component.set('data.avatar', normalizedUrl);
                        }
                    }
                } catch (e) {
                    console.log('Livewire update attempt:', e);
                }
                
                setTimeout(() => {
                    avatarInput.value = normalizedUrl;
                }, 100);
            }

            alert('Изображение установлено как главное. Нажмите "Сохранить" чтобы применить изменения.');
        };

        window.deleteGalleryImage{{ $getRecord()->id }} = function(imageUrl) {
            if (!confirm('ВЫ ТОЧНО ХОТИТЕ УДАЛИТЬ ЭТО ИЗОБРАЖЕНИЕ?\n\nПосле нажатия "Сохранить" оно будет УДАЛЕНО!')) {
                return;
            }

            console.log('=== НАЧАЛО УДАЛЕНИЯ ===');
            console.log('Удаляем URL:', imageUrl);

            const normalizedUrl = imageUrl
                .replace('https://woodstream.online', '')
                .replace('http://localhost', '')
                .replace('https:/', '')
                .replace('http:/', '')
                .replace(/\/\//g, '/');
            
            console.log('Нормализованный URL:', normalizedUrl);

            const imagesInput = document.querySelector('textarea[name="images"]');
            const deleteInput = document.querySelector('input[name="images_to_delete"]');
            
            console.log('Images textarea найден:', !!imagesInput);
            console.log('Delete input найден:', !!deleteInput);

            let currentImages = [];
            if (imagesInput) {
                try {
                    const rawValue = imagesInput.value || '[]';
                    console.log('Текущее значение images:', rawValue);
                    currentImages = JSON.parse(rawValue);
                    console.log('Распарсенные images:', currentImages);
                } catch (e) {
                    console.error('Ошибка парсинга:', e);
                    currentImages = [];
                }

                const beforeLength = currentImages.length;
                currentImages = currentImages.filter(img => {
                    const normalizedImg = img
                        .replace('https://woodstream.online', '')
                        .replace('http://localhost', '')
                        .replace('https:/', '')
                        .replace('http:/', '')
                        .replace(/\/\//g, '/');
                    
                    const shouldKeep = normalizedImg !== normalizedUrl;
                    if (!shouldKeep) {
                        console.log('УДАЛЯЕМ:', img);
                    }
                    return shouldKeep;
                });
                
                console.log(`Было фото: ${beforeLength}, Осталось: ${currentImages.length}`);

                const newValue = JSON.stringify(currentImages);
                imagesInput.value = newValue;
                console.log('Новое значение images:', newValue);
                
                imagesInput.dispatchEvent(new Event('change', { bubbles: true }));
                imagesInput.dispatchEvent(new Event('input', { bubbles: true }));
                imagesInput.dispatchEvent(new Event('blur', { bubbles: true }));
            }

            if (deleteInput) {
                let toDelete = [];
                try {
                    toDelete = JSON.parse(deleteInput.value || '[]');
                } catch (e) {
                    toDelete = [];
                }
                
                if (!toDelete.includes(normalizedUrl)) {
                    toDelete.push(normalizedUrl);
                }
                
                const newDeleteValue = JSON.stringify(toDelete);
                deleteInput.value = newDeleteValue;
                console.log('Images to delete:', newDeleteValue);
                
                deleteInput.dispatchEvent(new Event('change', { bubbles: true }));
                deleteInput.dispatchEvent(new Event('input', { bubbles: true }));
            }

            const imageElement = document.querySelector(`[data-image-url="${imageUrl}"]`);
            if (imageElement) {
                console.log('Удаляем элемент из DOM');
                imageElement.remove();
                
                const grid = document.getElementById('gallery-grid-{{ $getRecord()->id }}');
                const remaining = grid ? grid.querySelectorAll('[data-image-url]').length : 0;
                console.log('Осталось элементов в галерее:', remaining);
                
                const counter = document.querySelector('.text-sm.text-gray-500');
                if (counter) {
                    counter.textContent = `Всего изображений: ${remaining}`;
                }
            }

            alert('✅ ФОТО ПОМЕЧЕНО НА УДАЛЕНИЕ!\n\nНажмите кнопку "СОХРАНИТЬ" внизу страницы, чтобы удалить фото окончательно!');
            console.log('=== КОНЕЦ УДАЛЕНИЯ ===');
        };
    </script>
@endif

