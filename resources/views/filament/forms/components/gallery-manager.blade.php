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
    <div 
        x-data="{
            images: @js(array_values($images)),
            setAsMain(imageUrl) {
                if (!confirm('Сделать это изображение главным?')) {
                    return;
                }
                
                let normalizedUrl = imageUrl
                    .replace('https://woodstream.online', '')
                    .replace('https:/', '')
                    .replace('//', '/');
                
                this.$wire.set('data.avatar', normalizedUrl);
                
                alert('Изображение установлено как главное. Нажмите \"Сохранить\" чтобы применить изменения.');
            },
            deleteImage(imageUrl) {
                if (!confirm('Вы уверены, что хотите удалить это изображение?')) {
                    return;
                }
                
                let normalizedUrl = imageUrl
                    .replace('https://woodstream.online', '')
                    .replace('https:/', '')
                    .replace('//', '/');
                
                this.images = this.images.filter(img => {
                    let normalizedImg = img
                        .replace('https://woodstream.online', '')
                        .replace('https:/', '')
                        .replace('//', '/');
                    return normalizedImg !== normalizedUrl;
                });
                
                let currentImages = this.images.map(img => {
                    return img
                        .replace('https://woodstream.online', '')
                        .replace('https:/', '')
                        .replace('//', '/');
                });
                
                this.$wire.set('data.images', JSON.stringify(currentImages));
                
                let toDelete = [];
                try {
                    toDelete = JSON.parse(this.$wire.get('data.images_to_delete') || '[]');
                } catch (e) {
                    toDelete = [];
                }
                toDelete.push(normalizedUrl);
                this.$wire.set('data.images_to_delete', JSON.stringify(toDelete));
                
                setTimeout(() => {
                    window.location.reload();
                }, 300);
            }
        }"
        class="rounded-lg border border-gray-300 dark:border-gray-700 p-4 bg-white dark:bg-gray-800"
    >
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <template x-for="(imageUrl, index) in images" :key="index">
                <div class="flex flex-col">
                    <img 
                        :src="imageUrl" 
                        :alt="'Изображение ' + (index + 1)" 
                        class="w-full h-32 object-cover rounded-lg shadow-md mb-2"
                        onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'100\' height=\'100\'%3E%3Crect fill=\'%23ddd\' width=\'100\' height=\'100\'/%3E%3Ctext fill=\'%23999\' x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\' font-size=\'12\'%3EОшибка%3C/text%3E%3C/svg%3E'"
                    >
                    <div class="flex gap-2 justify-center">
                        <a 
                            href="javascript:void(0)" 
                            @click.prevent="setAsMain(imageUrl)"
                            class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300 text-sm font-medium underline cursor-pointer"
                        >
                            Сделать главным
                        </a>
                        <span class="text-gray-400">|</span>
                        <a 
                            href="javascript:void(0)" 
                            @click.prevent="deleteImage(imageUrl)"
                            class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 text-sm font-medium underline cursor-pointer"
                        >
                            Удалить
                        </a>
                    </div>
                </div>
            </template>
        </div>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-4">
            Всего изображений: <span x-text="images.length"></span>
        </p>
    </div>
@endif

