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
            $img = str_replace('\\', '/', $img);

            if (str_starts_with($img, 'http')) {
                return $img;
            }

            if (!str_starts_with($img, '/')) {
                $img = '/' . $img;
            }

            $img = preg_replace('#/+#', '/', $img);

            // Используем config('app.url') вместо жестко прописанного домена
            $baseUrl = rtrim(config('app.url'), '/');
            $img = $baseUrl . $img;

            return $img;
        }, $images ?: []);
    }
@endphp

@if(!empty($images))
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css">
    
    <div class="rounded-lg border border-gray-300 dark:border-gray-700 p-4 bg-white dark:bg-gray-800">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="gallery-grid-{{ $getRecord()->id }}">
            @foreach($images as $index => $imageUrl)
                <div class="flex flex-col" data-image-url="{{ $imageUrl }}">
                    <a 
                        href="{{ $imageUrl }}" 
                        data-fancybox="gallery-{{ $getRecord()->id }}"
                        data-caption="Изображение {{ $index + 1 }}"
                        class="block mb-2 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-200 cursor-zoom-in relative group"
                    >
                        <img 
                            src="{{ $imageUrl }}" 
                            alt="Изображение {{ $index + 1 }}" 
                            class="w-full h-48 object-contain bg-gray-50 dark:bg-gray-900"
                            onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'100\' height=\'100\'%3E%3Crect fill=\'%23ddd\' width=\'100\' height=\'100\'/%3E%3Ctext fill=\'%23999\' x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\' font-size=\'12\'%3EОшибка%3C/text%3E%3C/svg%3E'"
                        >
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-200 flex items-center justify-center">
                            <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                        </div>
                    </a>
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

    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        if (typeof Fancybox !== 'undefined') {
            Fancybox.bind('[data-fancybox="gallery-{{ $getRecord()->id }}"]', {
                Toolbar: {
                    display: {
                        left: ["infobar"],
                        middle: [],
                        right: ["slideshow", "thumbs", "close"]
                    }
                },
                Thumbs: {
                    autoStart: false
                }
            });
        }
        
        window.setAsMainImage{{ $getRecord()->id }} = function(imageUrl) {
            if (!confirm('Сделать это изображение главным?')) {
                return;
            }

            console.log('=== SWAP ГЛАВНОГО ФОТО ===');
            console.log('Новое главное:', imageUrl);

            const normalizedNewMain = imageUrl
                .replace(/https?:\/\/[^\/]+/g, '')
                .replace(/\/\//g, '/');
            
            console.log('Нормализованное новое главное:', normalizedNewMain);

            const formElement = document.querySelector('form');
            let livewireComponent = null;
            
            if (formElement) {
                const wireId = formElement.getAttribute('wire:id');
                if (wireId && window.Livewire) {
                    livewireComponent = window.Livewire.find(wireId);
                }
            }
            
            if (!livewireComponent) {
                const allWireElements = document.querySelectorAll('[wire\\:id]');
                for (const el of allWireElements) {
                    const wireId = el.getAttribute('wire:id');
                    const comp = window.Livewire.find(wireId);
                    if (comp && comp.get && comp.get('data')) {
                        livewireComponent = comp;
                        break;
                    }
                }
            }

            if (!livewireComponent) {
                alert('❌ ОШИБКА: Не удалось найти компонент формы.');
                return;
            }

            const oldAvatar = livewireComponent.get('data.avatar') || '';
            console.log('Старое главное фото:', oldAvatar);

            let currentImages = [];
            try {
                currentImages = livewireComponent.get('data.images');
                if (typeof currentImages === 'string') {
                    currentImages = JSON.parse(currentImages);
                }
                if (!Array.isArray(currentImages)) {
                    currentImages = [];
                }
            } catch (e) {
                currentImages = [];
            }

            console.log('Текущая галерея (до):', currentImages);

            const normalizedOldAvatar = oldAvatar
                .replace(/https?:\/\/[^\/]+/g, '')
                .replace(/\/\//g, '/');

            currentImages = currentImages.filter(img => {
                const normalized = img
                    .replace(/https?:\/\/[^\/]+/g, '')
                    .replace(/\/\//g, '/');
                return normalized !== normalizedNewMain;
            });

            if (normalizedOldAvatar && normalizedOldAvatar !== '') {
                currentImages.push(normalizedOldAvatar);
            }

            console.log('Новая галерея (после):', currentImages);

            livewireComponent.set('data.avatar', normalizedNewMain);
            livewireComponent.set('data.images', JSON.stringify(currentImages));

            const avatarInput = document.querySelector('input[name="avatar"]');
            if (avatarInput) {
                avatarInput.value = normalizedNewMain;
                avatarInput.dispatchEvent(new Event('change', { bubbles: true }));
                avatarInput.dispatchEvent(new Event('input', { bubbles: true }));
            }

            console.log('✅ SWAP завершен!');
            alert('✅ Фото ПЕРЕСТАВЛЕНЫ МЕСТАМИ!\n\nНажмите "СОХРАНИТЬ" чтобы применить изменения.');
        };

        window.deleteGalleryImage{{ $getRecord()->id }} = function(imageUrl) {
            if (!confirm('ВЫ ТОЧНО ХОТИТЕ УДАЛИТЬ ЭТО ИЗОБРАЖЕНИЕ?\n\nПосле нажатия "Сохранить" оно будет УДАЛЕНО!')) {
                return;
            }

            console.log('=== НАЧАЛО УДАЛЕНИЯ ===');
            console.log('Удаляем URL:', imageUrl);

            const normalizedUrl = imageUrl
                .replace(/https?:\/\/[^\/]+/g, '')
                .replace(/\/\//g, '/');
            
            console.log('Нормализованный URL:', normalizedUrl);

            const formElement = document.querySelector('form');
            let livewireComponent = null;
            
            if (formElement) {
                const wireId = formElement.getAttribute('wire:id');
                if (wireId && window.Livewire) {
                    livewireComponent = window.Livewire.find(wireId);
                    console.log('✅ Livewire компонент найден через форму');
                }
            }
            
            if (!livewireComponent) {
                const allWireElements = document.querySelectorAll('[wire\\:id]');
                console.log('Всего элементов с wire:id:', allWireElements.length);
                for (const el of allWireElements) {
                    const wireId = el.getAttribute('wire:id');
                    const comp = window.Livewire.find(wireId);
                    if (comp && comp.get && comp.get('data')) {
                        livewireComponent = comp;
                        console.log('✅ Livewire компонент найден через перебор');
                        break;
                    }
                }
            }

            let currentImages = [];
            
            if (livewireComponent) {
                console.log('✅ Livewire компонент найден');
                
                try {
                    currentImages = livewireComponent.get('data.images');
                    if (typeof currentImages === 'string') {
                        currentImages = JSON.parse(currentImages);
                    }
                    if (!Array.isArray(currentImages)) {
                        currentImages = [];
                    }
                    console.log('Текущие images из Livewire:', currentImages);
                } catch (e) {
                    console.error('Ошибка получения images из Livewire:', e);
                    currentImages = [];
                }

                const beforeLength = currentImages.length;
                currentImages = currentImages.filter(img => {
                    const normalizedImg = img
                        .replace(/https?:\/\/[^\/]+/g, '')
                        .replace(/\/\//g, '/');
                    
                    const shouldKeep = normalizedImg !== normalizedUrl;
                    if (!shouldKeep) {
                        console.log('УДАЛЯЕМ:', img);
                    }
                    return shouldKeep;
                });
                
                console.log(`Было фото: ${beforeLength}, Осталось: ${currentImages.length}`);

                const newValue = JSON.stringify(currentImages);
                console.log('Новое значение images:', newValue);
                
                livewireComponent.set('data.images', newValue);
                console.log('✅ Livewire state обновлен!');
                
                let toDelete = [];
                try {
                    const currentDeleteValue = livewireComponent.get('data.images_to_delete');
                    toDelete = currentDeleteValue ? JSON.parse(currentDeleteValue) : [];
                } catch (e) {
                    toDelete = [];
                }
                
                if (!toDelete.includes(normalizedUrl)) {
                    toDelete.push(normalizedUrl);
                }
                
                const newDeleteValue = JSON.stringify(toDelete);
                livewireComponent.set('data.images_to_delete', newDeleteValue);
                console.log('✅ Images to delete обновлены:', newDeleteValue);
            } else {
                console.error('❌ Livewire компонент НЕ найден!');
                alert('❌ ОШИБКА: Не удалось найти компонент формы.\n\nПопробуйте перезагрузить страницу.');
                return;
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

            console.log('✅ ФОТО УДАЛЕНО! Не забудь нажать СОХРАНИТЬ!');
            console.log('=== КОНЕЦ УДАЛЕНИЯ ===');
        };
    </script>
@endif

