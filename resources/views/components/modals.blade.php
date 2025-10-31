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
    $allModals = \App\Models\Modal::getActiveModals();
@endphp

@foreach($allModals as $index => $modal)
<div class="modal modal-promo {{ $modal->is_fixed ? 'modal-promo--fixed' : 'modal-promo--dynamic' }} modal-promo-{{ $index }}" 
     data-modal-id="{{ $modal->id }}" 
     data-delay="{{ $modal->delay_seconds }}" 
     data-order="{{ $modal->order }}" 
     data-active="true"
     data-index="{{ $index }}">
    <div class="modal-content">
        @if($modal->is_fixed)
            <div class="modal-close modal-promo__close--fixed" data-modal-index="{{ $index }}">
                <img src="{{ asset('images/icons/moda-close.svg') }}" alt="Close">
            </div>
            <a href="{{ $modal->url }}" target="_blank" class="modal-promo__body">
                <picture class="modal-promo__image">
                    <source media="(max-width: 768px)" srcset="{{ $modal->image_mobile }}">
                    <img src="{{ $modal->image }}" alt="{{ $modal->title }}">
                </picture>
            </a>
        @else
            <div class="modal-promo__body" style="background: white; border-radius: 10px !important; overflow: hidden; max-width: 310px; margin: 0 auto;">
                @if($modal->title)
                    <div style="padding: 10px 15px; background: #f9fafb; border-bottom: 1px solid #e5e7eb; position: relative;">
                        <div class="modal-close modal-promo__close--dynamic" data-modal-index="{{ $index }}">
                            <img src="{{ asset('images/icons/moda-close.svg') }}" alt="Close">
                        </div>
                        <h2 style="margin: 0; font-size: 18px; font-weight: 500; color: #1D2229; text-align: left;">{{ $modal->title }}</h2>
                    </div>
                @endif
                
                @if($modal->image)
                    <div style="width: 100%;">
                        <picture class="modal-promo__image">
                            @if($modal->image_mobile)
                                <source media="(max-width: 768px)" srcset="{{ $modal->image_mobile }}">
                            @endif
                            <img src="{{ $modal->image }}" alt="{{ $modal->title }}" style="width: 100%; height: auto; display: block; max-height: 100%;">
                        </picture>
                    </div>
                @endif
                
                <div style="padding: 10px 15px; background: white;">
                    <x-modal-buttons :modal="$modal" />
                </div>
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

