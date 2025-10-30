@php
    $record = $getRecord();
    $avatarUrl = $record ? $record->avatar : null;
    
    if ($avatarUrl) {
        $avatarUrl = str_replace('\\', '/', $avatarUrl);
        
        if (!str_starts_with($avatarUrl, 'http')) {
            if (!str_starts_with($avatarUrl, '/')) {
                $avatarUrl = '/' . $avatarUrl;
            }
            
            $avatarUrl = preg_replace('#/+#', '/', $avatarUrl);
            $avatarUrl = rtrim(config('app.url'), '/') . $avatarUrl;
        }
    }
@endphp

@if($avatarUrl)
    <div class="rounded-lg border border-gray-300 dark:border-gray-700 p-4 bg-white dark:bg-gray-800 relative">
        <img 
            src="{{ $avatarUrl }}" 
            alt="Главное изображение" 
            class="max-w-full h-auto rounded-lg shadow-md"
            style="max-height: 400px; object-fit: contain;"
            onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'200\' height=\'200\'%3E%3Crect fill=\'%23ddd\' width=\'200\' height=\'200\'/%3E%3Ctext fill=\'%23999\' x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\'%3EОшибка загрузки%3C/text%3E%3C/svg%3E'"
        >
        <button 
            type="button"
            onclick="deleteAvatar()"
            class="absolute top-6 right-6 bg-red-600 hover:bg-red-700 text-white rounded-lg px-4 py-2 shadow-lg transition-all duration-200 flex items-center gap-2"
            title="Удалить главное изображение"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
            Удалить
        </button>
    </div>

    <script>
        function deleteAvatar() {
            if (!confirm('Вы уверены, что хотите удалить главное изображение?')) {
                return;
            }

            const avatarInput = document.querySelector('[name="avatar"]');
            const deleteInput = document.querySelector('[name="delete_avatar"]');
            
            if (avatarInput) {
                avatarInput.value = '';
                avatarInput.dispatchEvent(new Event('input', { bubbles: true }));
            }
            
            if (deleteInput) {
                deleteInput.value = '1';
            }
            
            window.location.reload();
        }
    </script>
@endif

