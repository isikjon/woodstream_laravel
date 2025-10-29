@props(['class' => ''])

@php
$urls = cache()->remember('duty_manager_socials', 300, function () {
    try {
        $duty = \App\Models\DutySchedule::getCurrentDuty();
        $manager = $duty?->manager;
        
        if (!$manager) {
            return [
                'telegram' => '#',
                'whatsapp' => '#',
                'instagram' => '#',
                'vk' => '#',
            ];
        }
        
        return [
            'telegram' => $manager->telegram_link ?: '#',
            'whatsapp' => $manager->whatsapp_link ?: '#',
            'instagram' => $manager->instagram_link ?: '#',
            'vk' => 'https://vk.com/club87567029',
        ];
    } catch (\Exception $e) {
        return [
            'telegram' => '#',
            'whatsapp' => '#',
            'instagram' => '#',
            'vk' => '#',
        ];
    }
});
@endphp

@if($class === 'header__socials-links')
    <a href="{{ $urls['telegram'] }}" class="header__social header__social--telegram" aria-label="telegram">
        <img src="{{ asset('images/icons/telegram.svg') }}" alt="">
    </a>
    <a href="{{ $urls['whatsapp'] }}" class="header__social header__social--whatsapp" aria-label="whatsapp">
        <img src="{{ asset('images/icons/whatsapp.svg') }}" alt="">
    </a>
    <a href="{{ $urls['instagram'] }}" class="header__social header__social--instagram" aria-label="instagram">
        <img src="{{ asset('images/icons/instagram.svg') }}" alt="">
    </a>
    <a href="{{ $urls['vk'] }}" class="header__social header__social--vk" aria-label="vk">
        <img src="{{ asset('images/icons/vk.svg') }}" alt="">
    </a>
@elseif($class === 'footer-socials')
    <a href="{{ $urls['telegram'] }}" class="footer-socials__item footer-socials__item--telegram" aria-label="telegram">
        <img src="{{ asset('images/icons/telegram.svg') }}" alt="">
    </a>
    <a href="{{ $urls['whatsapp'] }}" class="footer-socials__item footer-socials__item--whatsapp" aria-label="whatsapp">
        <img src="{{ asset('images/icons/whatsapp.svg') }}" alt="">
    </a>
    <a href="{{ $urls['instagram'] }}" class="footer-socials__item footer-socials__item--instagram" aria-label="instagram">
        <img src="{{ asset('images/icons/instagram.svg') }}" alt="">
    </a>
    <a href="{{ $urls['vk'] }}" class="footer-socials__item footer-socials__item--vk" aria-label="vk">
        <img src="{{ asset('images/icons/vk.svg') }}" alt="">
    </a>
@elseif($class === 'header-menu__socials')
    <a href="{{ $urls['telegram'] }}" class="header-menu__contacts-link" aria-label="telegram">
        <img src="{{ asset('images/icons/telegram.svg') }}" alt="">
    </a>
    <a href="{{ $urls['whatsapp'] }}" class="header-menu__contacts-link" aria-label="whatsapp">
        <img src="{{ asset('images/icons/whatsapp.svg') }}" alt="">
    </a>
    <a href="{{ $urls['instagram'] }}" class="header-menu__contacts-link" aria-label="instagram">
        <img src="{{ asset('images/icons/instagram.svg') }}" alt="">
    </a>
    <a href="{{ $urls['vk'] }}" class="header-menu__contacts-link" aria-label="vk">
        <img src="{{ asset('images/icons/vk.svg') }}" alt="">
    </a>
@else
    <div class="social-links {{ $class }}">
        <a href="{{ $urls['telegram'] }}" class="social-links__item social-links__item--telegram" aria-label="telegram">
            <img src="{{ asset('images/icons/telegram.svg') }}" alt="">
        </a>
        <a href="{{ $urls['whatsapp'] }}" class="social-links__item social-links__item--whatsapp" aria-label="whatsapp">
            <img src="{{ asset('images/icons/whatsapp.svg') }}" alt="">
        </a>
        <a href="{{ $urls['instagram'] }}" class="social-links__item social-links__item--instagram" aria-label="instagram">
            <img src="{{ asset('images/icons/instagram.svg') }}" alt="">
        </a>
        <a href="{{ $urls['vk'] }}" class="social-links__item social-links__item--vk" aria-label="vk">
            <img src="{{ asset('images/icons/vk.svg') }}" alt="">
        </a>
    </div>
@endif
