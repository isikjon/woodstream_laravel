@php
$dutyData = cache()->remember('duty_whatsapp_' . now()->format('Y-m-d'), 3600, function () {
    try {
        $dutyService = app(\App\Services\DutyScheduleService::class);
        $duty = $dutyService->getTodayDuty();
        $phone = $duty?->manager?->phone;
        $cleanPhone = preg_replace('/[^\d]/', '', (string) $phone);
        
        if ($cleanPhone && strlen($cleanPhone) === 11 && $cleanPhone[0] === '8') {
            $cleanPhone = '7' . substr($cleanPhone, 1);
        }
        
        return [
            'phone' => $phone,
            'whatsapp_link' => $cleanPhone ? "https://wa.me/{$cleanPhone}" : null
        ];
    } catch (\Exception $e) {
        return ['phone' => null, 'whatsapp_link' => null];
    }
});
@endphp

@if($dutyData['whatsapp_link'])
<a href="{{ $dutyData['whatsapp_link'] }}" 
   class="whatsapp-float" 
   target="_blank" 
   rel="noopener noreferrer"
   aria-label="Написать в WhatsApp">
    <img src="{{ asset('images/whatsapp.png') }}" alt="WhatsApp">
</a>

<style>
.whatsapp-float {
    position: fixed;
    width: 60px;
    height: 60px;
    bottom: 40px;
    right: 40px;
    background-color: #25D366;
    color: #FFF;
    border-radius: 50px;
    text-align: center;
    font-size: 30px;
    box-shadow: 2px 2px 10px rgba(0,0,0,0.3);
    z-index: 100;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    animation: whatsapp-pulse 2s infinite;
}

.whatsapp-float:hover {
    transform: scale(1.1);
    box-shadow: 2px 2px 15px rgba(0,0,0,0.4);
    animation-play-state: paused;
}

.whatsapp-float img {
    width: 50px;
    height: 50px;
}

/* Пульсирующий эффект */
@keyframes whatsapp-pulse {
    0% {
        box-shadow: 2px 2px 10px rgba(0,0,0,0.3), 0 0 0 0 rgba(37, 211, 102, 0.7);
    }
    50% {
        box-shadow: 2px 2px 10px rgba(0,0,0,0.3), 0 0 0 10px rgba(37, 211, 102, 0.3);
    }
    100% {
        box-shadow: 2px 2px 10px rgba(0,0,0,0.3), 0 0 0 20px rgba(37, 211, 102, 0);
    }
}

/* Дополнительный пульсирующий эффект */
.whatsapp-float::before {
    content: '';
    position: absolute;
    top: -5px;
    left: -5px;
    right: -5px;
    bottom: -5px;
    background-color: #25D366;
    border-radius: 50px;
    opacity: 0.3;
    animation: whatsapp-ripple 2s infinite;
    z-index: -1;
}

@keyframes whatsapp-ripple {
    0% {
        transform: scale(0.8);
        opacity: 0.3;
    }
    50% {
        transform: scale(1.2);
        opacity: 0.1;
    }
    100% {
        transform: scale(1.5);
        opacity: 0;
    }
}

@media screen and (max-width: 768px) {
    .whatsapp-float {
        width: 50px;
        height: 50px;
        bottom: 20px;
        right: 20px;
    }
    
    .whatsapp-float img {
        width: 40px;
        height: 40px;
    }
}
</style>
@endif

