@props(['modal'])

@php
// Получаем данные текущего дежурного
$dutyData = cache()->remember('duty_modal_' . now()->format('Y-m-d'), 3600, function () {
    try {
        $dutyService = app(\App\Services\DutyScheduleService::class);
        $duty = $dutyService->getTodayDuty();
        
        if (!$duty || !$duty->manager) {
            return null;
        }
        
        $phone = $duty->manager->phone;
        $whatsapp = $duty->whatsapp ?? $phone;
        $telegram = $duty->telegram;
        $instagram = $duty->instagram;
        
        // Очищаем номер для WhatsApp
        $cleanPhone = preg_replace('/[^\d]/', '', (string) $whatsapp);
        if ($cleanPhone && strlen($cleanPhone) === 11 && $cleanPhone[0] === '8') {
            $cleanPhone = '7' . substr($cleanPhone, 1);
        }
        
        return [
            'whatsapp' => $cleanPhone,
            'telegram' => $telegram ? ltrim($telegram, '@') : null,
            'instagram' => $instagram,
        ];
    } catch (\Exception $e) {
        \Log::error('Modal buttons duty data error: ' . $e->getMessage());
        return null;
    }
});

// Функция для получения URL кнопки
function getButtonUrl($modal, $buttonNum, $dutyData) {
    $type = $buttonNum === 1 ? $modal->button_1_type : $modal->button_2_type;
    $url = $buttonNum === 1 ? $modal->button_1_url : $modal->button_2_url;
    
    // Если это WhatsApp или Telegram, используем данные дежурного
    if ($dutyData) {
        if ($type === 'whatsapp' && !empty($dutyData['whatsapp'])) {
            return 'https://wa.me/' . $dutyData['whatsapp'];
        } elseif ($type === 'telegram' && !empty($dutyData['telegram'])) {
            return 'https://t.me/' . $dutyData['telegram'];
        }
    }
    
    // Иначе используем статичные данные из базы
    if ($type === 'telegram') {
        return 'https://t.me/' . ltrim($url, '@');
    } elseif ($type === 'whatsapp') {
        return 'https://wa.me/' . preg_replace('/[^\d]/', '', $url);
    }
    
    return $url;
}
@endphp

<div class="modal-buttons" style="display: flex; gap: 15px; justify-content: center;">
    @if($modal->button_1_text && $modal->button_1_url)
        <a href="{{ getButtonUrl($modal, 1, $dutyData) }}" 
           target="_blank"
           style="
               flex: 1;
               padding: 8px 12px;
               border-radius: 8px;
               text-decoration: none;
               font-weight: 400;
               font-size: 15px;
               text-align: center;
               transition: all 0.3s ease;
               display: block;
               {{ $modal->button_1_type === 'telegram' ? 'background-color: #1D2229; color: #ffffff;' : ($modal->button_1_type === 'whatsapp' ? 'background-color: #4CAF50; color: #ffffff;' : 'background-color: #667eea; color: #ffffff;') }}
           "
           onmouseover="this.style.opacity='0.9'"
           onmouseout="this.style.opacity='1'">
            {{ $modal->button_1_text }}
        </a>
    @endif

    @if($modal->button_2_text && $modal->button_2_url)
        <a href="{{ getButtonUrl($modal, 2, $dutyData) }}" 
           target="_blank"
           style="
               flex: 1;
               padding: 8px 12px;
               border-radius: 8px;
               text-decoration: none;
               font-weight: 400;
               font-size: 15px;
               text-align: center;
               transition: all 0.3s ease;
               display: block;
               {{ $modal->button_2_type === 'telegram' ? 'background-color: #1D2229; color: #ffffff;' : ($modal->button_2_type === 'whatsapp' ? 'background-color: #4CAF50; color: #ffffff;' : 'background-color: #667eea; color: #ffffff;') }}
           "
           onmouseover="this.style.opacity='0.9'"
           onmouseout="this.style.opacity='1'">
            {{ $modal->button_2_text }}
        </a>
    @endif
</div>

