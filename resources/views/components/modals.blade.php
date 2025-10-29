<div class="modal modal-theme ">
    <div class="modal-content">
        <div class="modal-top">
            <h3 class="modal-title">Выбор темы</h3>
            <div class="modal-close modal-theme__close"><img src="{{ asset('images/icons/moda-close.svg') }}" alt=""></div>
        </div>
        <div class="modal-body">
            <p class="modal-text">
                Выберите цвет оформления сайта
            </p>
            <div class="modal-theme__choose">
                <button class="modal-theme__item modal-theme__item--light">
                    Светлый
                </button>
                <button class="modal-theme__item modal-theme__item--dark">
                    Темный
                </button>
            </div>
        </div>
    </div>
</div>

@php
$activeModals = \App\Models\Modal::getActiveModals();
@endphp

@foreach($activeModals as $index => $modal)
@php
$buttonUrl1 = $modal->button_1_url;
$buttonUrl2 = $modal->button_2_url;

if ($modal->button_1_type === 'whatsapp' && $modal->button_1_url) {
    $buttonUrl1 = 'https://wa.me/' . preg_replace('/\D/', '', $modal->button_1_url);
} elseif ($modal->button_1_type === 'telegram' && $modal->button_1_url) {
    $buttonUrl1 = 'https://t.me/' . ltrim($modal->button_1_url, '@');
}

if ($modal->button_2_type === 'whatsapp' && $modal->button_2_url) {
    $buttonUrl2 = 'https://wa.me/' . preg_replace('/\D/', '', $modal->button_2_url);
} elseif ($modal->button_2_type === 'telegram' && $modal->button_2_url) {
    $buttonUrl2 = 'https://t.me/' . ltrim($modal->button_2_url, '@');
}

$imageDesktop = $modal->image ? asset('storage/' . $modal->image) : null;
$imageMobile = $modal->image_mobile ? asset('storage/' . $modal->image_mobile) : $imageDesktop;
@endphp

<div class="modal modal-custom modal-custom-{{ $index }}" 
     data-modal-id="{{ $modal->id }}" 
     data-delay="{{ $modal->delay_seconds }}" 
     data-order="{{ $modal->order }}" 
     data-active="true"
     data-index="{{ $index }}">
    <div class="modal-content">
        @if($modal->title)
        <div class="modal-top">
            <h3 class="modal-title">{{ $modal->title }}</h3>
            <div class="modal-close modal-custom__close" data-modal-index="{{ $index }}">
                <img src="{{ asset('images/icons/moda-close.svg') }}" alt="">
            </div>
        </div>
        @else
        <div class="modal-close modal-custom__close" data-modal-index="{{ $index }}" style="position: absolute; top: 10px; right: 10px; cursor: pointer; z-index: 10;">
            <img src="{{ asset('images/icons/moda-close.svg') }}" alt="">
        </div>
        @endif
        
        <div class="modal-custom__body">
            @if($modal->content && !$modal->image)
                {!! nl2br(e($modal->content)) !!}
            @endif
            
            @if($imageDesktop || $imageMobile)
                <picture class="modal-custom__image">
                    @if($imageMobile && $imageDesktop !== $imageMobile)
                        <source media="(max-width: 768px)" srcset="{{ $imageMobile }}">
                    @endif
                    <img src="{{ $imageDesktop }}" alt="{{ $modal->title }}" style="width: 100%; height: auto; display: block;">
                </picture>
            @endif
        </div>
        
        @if($modal->button_1_text || $modal->button_2_text)
        <div class="modal-bottom">
            @if($modal->button_1_text && $buttonUrl1)
                <a href="{{ $buttonUrl1 }}" class="modal-info__btn {{ $modal->button_1_type === 'whatsapp' ? 'modal-info__btn--whatsapp' : 'modal-info__btn--watch' }}" target="_blank">{{ $modal->button_1_text }}</a>
            @endif
            @if($modal->button_2_text && $buttonUrl2)
                <a href="{{ $buttonUrl2 }}" class="modal-info__btn {{ $modal->button_2_type === 'whatsapp' ? 'modal-info__btn--whatsapp' : 'modal-info__btn--order' }}" target="_blank">{{ $modal->button_2_text }}</a>
            @endif
        </div>
        @endif
    </div>
</div>
@endforeach

<div class="modal modal-login ">
    <div class="modal-content">
        <div class="modal-top">
            <h3 class="modal-title">Вход</h3>
            <div class="modal-close modal-login__close"><img src="{{ asset('images/icons/moda-close.svg') }}" alt=""></div>
        </div>
        <form class="form">
            <div class="modal-body">
                <h2 class="modal-login__title">Заполните данные для входа</h2>
                <div class="modal-inputs">
                    <label class="modal-label">
                        <input type="text" placeholder="Имя" class="modal-input" required
                            pattern="[А-Яа-яЁёA-Za-z\s\-]+">
                        <span>Недопустимые символы в поле "Имя"</span>
                    </label>
                    <input type="tel" placeholder="Телефон" class="modal-input" pattern="8\s\([0-9]{3}\)\s[0-9]{3}-[0-9]{2}-[0-9]{2}" required>
                    <input type="email" placeholder="E-mail" class="modal-input">
                </div>
                <label class="modal-checkbox">
                    <input type="checkbox" name="checkbox" id="" checked required>
                    <span></span>
                    <p>
                        Я принимаю условия политики обработки <a href="#">персональных данных</a>
                    </p>
                </label>
                <label class="modal-checkbox">
                    <input type="checkbox" name="checkbox" id="" checked required>
                    <span></span>
                    <p>
                        Подписка на рассылку
                    </p>
                </label>
            </div>
            <div class="modal-bottom">
                <button class="modal-login__btn">Войти</button>
            </div>
        </form>
    </div>
</div>

<div class="modal modal-success">
    <div class="modal-content">
        <div class="modal-top">
            <h3 class="modal-title"><img src="{{ asset('images/icons/check-icon.svg') }}" alt=""> Заявка отправлена</h3>
            <div class="modal-close modal-success__close"><img src="{{ asset('images/icons/moda-close.svg') }}" alt=""></div>
        </div>
        <div class="modal-body">
            <p class="modal-text">
                Ваш заказ успешно оформлен, мы свяжемся с Вами в ближайшее время
            </p>
        </div>
        <div class="modal-bottom">
            <button class="modal-success__btn">Закрыть</button>
        </div>
    </div>
</div>

