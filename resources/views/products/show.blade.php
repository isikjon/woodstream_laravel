@extends('layouts.base')

@section('title', $product->name . ' - WoodStream')

@section('content')
<x-breadcrumbs.index :items="[
    ['title' => 'Каталог', 'url' => route('catalog')],
    ['title' => $product->name]
]" />

<section class="product">
    <div class="container">
        <div class="product-grid">
            @if($product->special > 0)
                <div class="product-status">
                    Спец. цена
                </div>
            @elseif($product->priority > 0)
                <div class="product-status">
                    Новинка
                </div>
            @endif
            
            <div class="product-gallery">
                <div class="product-swiper swiper">
                    <div class="swiper-wrapper">
                        @if($product->main_image)
                            <div class="swiper-slide">
                                <img src="{{ $product->main_image }}" alt="{{ $product->name }}">
                            </div>
                        @endif
                        @foreach($product->gallery as $image)
                            <div class="swiper-slide">
                                <img src="{{ $image }}" alt="{{ $product->name }}">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination product-swiper__pagination"></div>
                    <div class="swiper-button-next product-swiper__next">
                        <img src="{{ asset('images/icons/bg-dark-slider-right.svg') }}" alt="">
                    </div>
                    <div class="swiper-button-prev product-swiper__prev">
                        <img src="{{ asset('images/icons/bg-dark-slider-left.svg') }}" alt="">
                    </div>
                </div>
                <div class="product-thumbs swiper">
                    <div class="swiper-wrapper">
                        @if($product->main_image)
                            <div class="swiper-slide">
                                <img src="{{ $product->main_image }}" alt="{{ $product->name }}">
                            </div>
                        @endif
                        @foreach($product->gallery as $image)
                            <div class="swiper-slide">
                                <img src="{{ $image }}" alt="{{ $product->name }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="product-infos">
                <div class="product-info">
                    <div class="product-date">
                        <div class="product-date__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <g clip-path="url(#clip0_38_4122)">
                                    <path d="M8 0C6.41775 0 4.87104 0.469192 3.55544 1.34824C2.23985 2.22729 1.21447 3.47672 0.608967 4.93853C0.00346629 6.40034 -0.15496 8.00887 0.153721 9.56072C0.462403 11.1126 1.22433 12.538 2.34315 13.6569C3.46197 14.7757 4.88743 15.5376 6.43928 15.8463C7.99113 16.155 9.59966 15.9965 11.0615 15.391C12.5233 14.7855 13.7727 13.7602 14.6518 12.4446C15.5308 11.129 16 9.58225 16 8C15.9977 5.87897 15.1541 3.84547 13.6543 2.34568C12.1545 0.845886 10.121 0.00229405 8 0ZM8 14.6667C6.68146 14.6667 5.39253 14.2757 4.2962 13.5431C3.19987 12.8106 2.34539 11.7694 1.84081 10.5512C1.33622 9.33305 1.2042 7.99261 1.46144 6.6994C1.71867 5.40619 2.35361 4.21831 3.28596 3.28596C4.21831 2.35361 5.4062 1.71867 6.6994 1.46143C7.99261 1.2042 9.33305 1.33622 10.5512 1.8408C11.7694 2.34539 12.8106 3.19987 13.5431 4.2962C14.2757 5.39253 14.6667 6.68146 14.6667 8C14.6649 9.76757 13.962 11.4622 12.7121 12.7121C11.4622 13.962 9.76757 14.6649 8 14.6667Z" fill="#989AA1" />
                                    <path d="M7.99964 4C7.82283 4 7.65326 4.07024 7.52823 4.19526C7.40321 4.32029 7.33297 4.48986 7.33297 4.66667V7.55L5.08564 8.958C4.93535 9.05189 4.82851 9.20163 4.78863 9.37429C4.74875 9.54695 4.77909 9.72838 4.87297 9.87867C4.96686 10.029 5.1166 10.1358 5.28926 10.1757C5.46192 10.2156 5.64335 10.1852 5.79364 10.0913L8.35364 8.49133C8.45036 8.43073 8.52991 8.34631 8.58465 8.24616C8.6394 8.146 8.66751 8.03347 8.66631 7.91933V4.66667C8.66631 4.48986 8.59607 4.32029 8.47104 4.19526C8.34602 4.07024 8.17645 4 7.99964 4Z" fill="#989AA1" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_38_4122">
                                        <rect width="16" height="16" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        @if($product->arrived_at)
                            {{ $product->arrived_at->format('d.m.Y') }}
                        @else
                            {{ now()->format('d.m.Y') }}
                        @endif
                    </div>
                    @if($product->country && is_object($product->country))
                        <div class="product-country">
                            <img src="{{ asset('images/icons/belgium.svg') }}" alt="">
                            {{ $product->country->name }}
                        </div>
                    @endif
                </div>
                <h4 class="product-name">
                    {{ $product->name }}
                </h4>
                <p class="product-description">
                    Описание товара носит информативный характер, экспертиза времени и места не проводилась:
                </p>
                <div class="product-details">
                    <div class="product-details__item">
                        <span class="product-details__title">Модель:</span>
                        <span class="product-details__line"></span>
                        <span class="product-details__value">{{ $product->model ?? 'N/A' }}</span>
                    </div>
                    @if($product->styles->count() > 0)
                        <div class="product-details__item">
                            <span class="product-details__title">Стили:</span>
                            <span class="product-details__line"></span>
                            <span class="product-details__value">{{ $product->styles->pluck('name')->join(', ') }}</span>
                        </div>
                    @endif
                    @if($product->city && is_object($product->city))
                        <div class="product-details__item">
                            <span class="product-details__title">В наличии в городе:</span>
                            <span class="product-details__line"></span>
                            <span class="product-details__value">{{ $product->city->name }}</span>
                        </div>
                    @endif
                    @if($product->century)
                        <div class="product-details__item">
                            <span class="product-details__title">Век:</span>
                            <span class="product-details__line"></span>
                            <span class="product-details__value">{{ $product->century }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="product-action">
                <form class="product-form">
                    <div class="product-type">
                        <img src="{{ asset('images/icons/check-icon.svg') }}" alt="">
                        <span>
                            @if($product->availability == 5)
                                Продан
                            @elseif($product->availability == 10)
                                Скоро в продаже
                            @elseif($product->availability == 8)
                                Под заказ
                            @elseif($product->availability == 9)
                                Забронировано
                            @elseif($product->availability == 11)
                                Под реставрацию
                            @else
                                В наличии
                            @endif
                        </span>
                    </div>
                <div class="product-price">
                    <span class="product-price__title">Цена:</span>
                    <span class="product-price__value">
                        @if($product->availability == 5)
                            <span style="color: #999;">Продано</span>
                        @elseif($product->special > 0)
                            {{ number_format($product->special, 0, ',', ' ') }} ₽
                        @else
                            {{ number_format($product->price, 0, ',', ' ') }} ₽
                        @endif
                    </span>
                </div>
                    <div class="product-inputs">
                        <label class="product-label">
                            <input type="text" placeholder="Имя" class="product-input" required pattern="[А-Яа-яЁёA-Za-z\s\-]+">
                            <span>Недопустимые символы в поле "Имя"</span>
                        </label>
                        <input type="tel" placeholder="Телефон" class="product-input" required>
                        <input type="email" placeholder="E-mail" class="product-input">
                        <button type="button" class="product-button">
                            Оформить заказ
                            <span class="product-button__arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="6" height="11" viewBox="0 0 6 11" fill="none">
                                    <path d="M0.472589 0.9177C0.410103 0.979675 0.360507 1.05341 0.326661 1.13465C0.292816 1.21589 0.27539 1.30302 0.27539 1.39103C0.27539 1.47904 0.292816 1.56618 0.326661 1.64742C0.360507 1.72866 0.410104 1.80239 0.472589 1.86436L3.52592 4.9177C3.58841 4.97967 3.638 5.05341 3.67185 5.13465C3.7057 5.21589 3.72312 5.30302 3.72312 5.39103C3.72312 5.47904 3.7057 5.56618 3.67185 5.64742C3.638 5.72866 3.58841 5.80239 3.52592 5.86437L0.472589 8.9177C0.410104 8.97967 0.360507 9.05341 0.326662 9.13465C0.292816 9.21589 0.275391 9.30302 0.275391 9.39103C0.275391 9.47904 0.292816 9.56618 0.326662 9.64742C0.360508 9.72866 0.410104 9.80239 0.472589 9.86437C0.597498 9.98853 0.766466 10.0582 0.942589 10.0582C1.11871 10.0582 1.28768 9.98853 1.41259 9.86437L4.47259 6.80437C4.84712 6.42936 5.0575 5.92103 5.0575 5.39103C5.0575 4.86103 4.84712 4.3527 4.47259 3.9777L1.41259 0.9177C1.28768 0.793532 1.11871 0.723837 0.942589 0.723837C0.766465 0.723837 0.597497 0.793532 0.472589 0.9177Z" fill="#F0F4FF" />
                                </svg>
                            </span>
                        </button>
                    </div>
                    <label class="product-checkbox">
                        <input type="checkbox" name="checkbox" id="" checked required>
                        <span></span>
                        <p>
                            Я принимаю условия политики обработки <a href="#">персональных данных</a>
                        </p>
                    </label>
                    <label class="product-checkbox">
                        <input type="checkbox" name="checkbox" id="" checked required>
                        <span></span>
                        <p>
                            Подписка на рассылку
                        </p>
                    </label>
                </form>
                <div class="product-additions">
                    <div class="product-additions__item">
                        <div class="product-additions__name">
                            <span class="product-additions__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <g clip-path="url(#clip0_38_4203)">
                                        <path d="M4.66667 0C4.48986 0 4.32029 0.0702379 4.19526 0.195262C4.07024 0.320286 4 0.489856 4 0.666667V2C4 2.53043 3.78929 3.03914 3.41421 3.41421C3.03914 3.78929 2.53043 4 2 4H0.666667C0.489856 4 0.320286 4.07024 0.195262 4.19526C0.0702379 4.32029 0 4.48986 0 4.66667C0 4.84348 0.0702379 5.01305 0.195262 5.13807C0.320286 5.2631 0.489856 5.33333 0.666667 5.33333H2C2.88373 5.33227 3.73096 4.98075 4.35585 4.35585C4.98075 3.73096 5.33227 2.88373 5.33333 2V0.666667C5.33333 0.489856 5.2631 0.320286 5.13807 0.195262C5.01305 0.0702379 4.84348 0 4.66667 0ZM15.3333 10.6667H14C13.1163 10.6677 12.269 11.0193 11.6441 11.6441C11.0193 12.269 10.6677 13.1163 10.6667 14V15.3333C10.6667 15.5101 10.7369 15.6797 10.8619 15.8047C10.987 15.9298 11.1565 16 11.3333 16C11.5101 16 11.6797 15.9298 11.8047 15.8047C11.9298 15.6797 12 15.5101 12 15.3333V14C12 13.4696 12.2107 12.9609 12.5858 12.5858C12.9609 12.2107 13.4696 12 14 12H15.3333C15.5101 12 15.6797 11.9298 15.8047 11.8047C15.9298 11.6797 16 11.5101 16 11.3333C16 11.1565 15.9298 10.987 15.8047 10.8619C15.6797 10.7369 15.5101 10.6667 15.3333 10.6667ZM14 5.33333H15.3333C15.5101 5.33333 15.6797 5.2631 15.8047 5.13807C15.9298 5.01305 16 4.84348 16 4.66667C16 4.48986 15.9298 4.32029 15.8047 4.19526C15.6797 4.07024 15.5101 4 15.3333 4H14C13.4696 4 12.9609 3.78929 12.5858 3.41421C12.2107 3.03914 12 2.53043 12 2V0.666667C12 0.489856 11.9298 0.320286 11.8047 0.195262C11.6797 0.0702379 11.5101 0 11.3333 0C11.1565 0 10.987 0.0702379 10.8619 0.195262C10.7369 0.320286 10.6667 0.489856 10.6667 0.666667V2C10.6677 2.88373 11.0193 3.73096 11.6441 4.35585C12.269 4.98075 13.1163 5.33227 14 5.33333ZM2 10.6667H0.666667C0.489856 10.6667 0.320286 10.7369 0.195262 10.8619C0.0702379 10.987 0 11.1565 0 11.3333C0 11.5101 0.0702379 11.6797 0.195262 11.8047C0.320286 11.9298 0.489856 12 0.666667 12H2C2.53043 12 3.03914 12.2107 3.41421 12.5858C3.78929 12.9609 4 13.4696 4 14V15.3333C4 15.5101 4.07024 15.6797 4.19526 15.8047C4.32029 15.9298 4.48986 16 4.66667 16C4.84348 16 5.01305 15.9298 5.13807 15.8047C5.2631 15.6797 5.33333 15.5101 5.33333 15.3333V14C5.33227 13.1163 4.98075 12.269 4.35585 11.6441C3.73096 11.0193 2.88373 10.6677 2 10.6667Z" fill="#909CAB" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_38_4203">
                                            <rect width="16" height="16" fill="white" />
                                        </clipPath>
                                    </defs>
                        </svg>
                    </span>
                    Примерные размеры
                </div>
                        @if($product->size)
                            <span class="product-additions__btn">{{ $product->size }}</span>
                        @else
                            <a href="#" class="product-additions__btn">Запросить</a>
                        @endif
                    </div>
                    <div class="product-additions__item">
                        <div class="product-additions__name">
                            <span class="product-additions__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <g clip-path="url(#clip0_38_4217)">
                                        <path d="M12.6667 2.66667H12.328L10.872 0.778667C10.6845 0.537093 10.4443 0.34142 10.1699 0.206501C9.89542 0.0715812 9.59383 0.000960792 9.288 0L6.712 0C6.40617 0.000960792 6.10458 0.0715812 5.83012 0.206501C5.55566 0.34142 5.31555 0.537093 5.128 0.778667L3.672 2.66667H3.33333C2.4496 2.66773 1.60237 3.01925 0.97748 3.64415C0.352588 4.26904 0.00105857 5.11627 0 6L0 12.6667C0.00105857 13.5504 0.352588 14.3976 0.97748 15.0225C1.60237 15.6474 2.4496 15.9989 3.33333 16H12.6667C13.5504 15.9989 14.3976 15.6474 15.0225 15.0225C15.6474 14.3976 15.9989 13.5504 16 12.6667V6C15.9989 5.11627 15.6474 4.26904 15.0225 3.64415C14.3976 3.01925 13.5504 2.66773 12.6667 2.66667ZM6.184 1.59333C6.24624 1.51248 6.32622 1.44699 6.41776 1.40191C6.5093 1.35684 6.60996 1.33337 6.712 1.33333H9.288C9.39004 1.33337 9.4907 1.35684 9.58224 1.40191C9.67379 1.44699 9.75376 1.51248 9.816 1.59333L10.644 2.66667H5.356L6.184 1.59333ZM14.6667 12.6667C14.6667 13.1971 14.456 13.7058 14.0809 14.0809C13.7058 14.456 13.1971 14.6667 12.6667 14.6667H3.33333C2.8029 14.6667 2.29419 14.456 1.91912 14.0809C1.54405 13.7058 1.33333 13.1971 1.33333 12.6667V6C1.33333 5.46957 1.54405 4.96086 1.91912 4.58579C2.29419 4.21071 2.8029 4 3.33333 4H12.6667C13.1971 4 13.7058 4.21071 14.0809 4.58579C14.456 4.96086 14.6667 5.46957 14.6667 6V12.6667Z" fill="#909CAB" />
                                        <path d="M8 5.33337C7.20888 5.33337 6.43552 5.56797 5.77772 6.0075C5.11992 6.44702 4.60723 7.07174 4.30448 7.80264C4.00173 8.53354 3.92252 9.33781 4.07686 10.1137C4.2312 10.8897 4.61216 11.6024 5.17157 12.1618C5.73098 12.7212 6.44372 13.1022 7.21964 13.2565C7.99556 13.4109 8.79983 13.3316 9.53074 13.0289C10.2616 12.7261 10.8864 12.2135 11.3259 11.5557C11.7654 10.8979 12 10.1245 12 9.33337C11.9989 8.27283 11.5772 7.25603 10.8273 6.50612C10.0773 5.7562 9.06054 5.33443 8 5.33337ZM8 12C7.47259 12 6.95701 11.8436 6.51848 11.5506C6.07995 11.2576 5.73816 10.8411 5.53632 10.3539C5.33449 9.86659 5.28168 9.33042 5.38457 8.81313C5.48747 8.29585 5.74144 7.8207 6.11438 7.44776C6.48732 7.07482 6.96248 6.82084 7.47976 6.71795C7.99704 6.61505 8.53322 6.66786 9.02049 6.8697C9.50776 7.07153 9.92424 7.41332 10.2173 7.85185C10.5103 8.29038 10.6667 8.80596 10.6667 9.33337C10.6667 10.0406 10.3857 10.7189 9.88562 11.219C9.38552 11.7191 8.70725 12 8 12Z" fill="#909CAB" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_38_4217">
                                            <rect width="16" height="16" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </span>
                            Дополнительные фотографии
                        </div>
                        <a href="#" class="product-additions__btn">Запросить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if($similarProducts->count() > 0)
<section class="similar">
    <div class="container">
        <div class="section-top">
            <h2 class="section-title">Похожие товары</h2>
            <a href="{{ route('catalog') }}" class="go-page">
                Перейти в каталог
                <img src="{{ asset('images/icons/arrow_right.svg') }}" alt="">
            </a>
        </div>
        <div class="similar-swiper">
            <div class="swiper">
                <div class="swiper-wrapper">
                    @foreach($similarProducts as $similar)
                        <div class="swiper-slide">
                            <div class="similar-item">
                                <a href="{{ route('product.show', $similar->id) }}" class="similar-item__image">
                                    <img src="{{ $similar->main_image }}" alt="{{ $similar->name }}">
                                </a>
                                <div class="similar-item__content">
                                    <div class="similar-item__info">
                                        <span class="similar-item__code">{{ $similar->model ?? 'N/A' }}</span>
                                        <p class="similar-item__status">
                                            <img src="{{ asset('images/icons/check-icon.svg') }}" alt=""> 
                                            @if($similar->availability == 5)
                                                Продан
                                            @elseif($similar->availability == 10)
                                                Скоро в продаже
                                            @elseif($similar->availability == 8)
                                                Под заказ
                                            @else
                                                В наличии
                                            @endif
                                        </p>
                                    </div>
                                <div class="similar-item__price">
                                    @if($similar->availability == 5)
                                        <span style="color: #999;">Продано</span>
                                    @else
                                        {{ number_format($similar->price, 0, ',', ' ') }} ₽
                                    @endif
                                </div>
                                    <h3 class="similar-item__title">
                                        {{ $similar->name }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper-button-next similar-button__next">
                <img src="{{ asset('images/icons/slider-right.svg') }}" alt="">
            </div>
            <div class="swiper-button-prev similar-button__prev">
                <img src="{{ asset('images/icons/slider-left.svg') }}" alt="">
            </div>
        </div>
    </div>
</section>
@endif

@if($weeklyProducts->count() > 0)
<section class="weekly">
    <div class="container">
        <h2 class="section-title">Новинки недели</h2>
        <div class="weekly-grid">
            @foreach($weeklyProducts as $weekly)
                <a href="{{ route('product.show', $weekly->id) }}" class="weekly-product">
                    <div class="weekly-product__image">
                        <img src="{{ $weekly->main_image }}" alt="{{ $weekly->name }}">
                    </div>
                    @if($weekly->special > 0)
                        <span class="weekly-product__type">Спец. цена</span>
                    @elseif($weekly->priority > 0)
                        <span class="weekly-product__type">Новинка</span>
                    @endif
                    <div class="weekly-product__content">
                        <div class="weekly-product__info">
                            <span class="weekly-product__code">{{ $weekly->model ?? 'N/A' }}</span>
                            <p class="weekly-product__status">
                                <img src="{{ asset('images/icons/check-icon.svg') }}" alt=""> 
                                @if($weekly->availability == 5)
                                    Продан
                                @elseif($weekly->availability == 10)
                                    Скоро в продаже
                                @elseif($weekly->availability == 8)
                                    Под заказ
                                @else
                                    В наличии
                                @endif
                            </p>
                        </div>
                    <div class="weekly-product__price">
                        @if($weekly->availability == 5)
                            <span style="color: #999;">Продано</span>
                        @else
                            {{ number_format($weekly->price, 0, ',', ' ') }} ₽
                        @endif
                    </div>
                        <h3 class="weekly-product__title">{{ $weekly->name }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
        <button class="weekly-all">
            <span>Показать ещё</span>
            <img src="{{ asset('images/icons/arrow_down.svg') }}" alt="">
        </button>
    </div>
</section>
@endif

<section class="category">
    <div class="container">
        <div class="section-top">
            <h2 class="section-title">Другие категории</h2>
            <a href="{{ route('catalog') }}" class="go-page">
                Перейти в каталог
                <img src="{{ asset('images/icons/arrow_right.svg') }}" alt="">
            </a>
        </div>
        <div class="category-block">
            <a href="{{ route('catalog') }}" class="category-item category-item--half">
                <span class="category-item__title">Кровати</span>
                <img src="{{ asset('images/content/category_1.png') }}" alt="">
            </a>
            <a href="{{ route('catalog') }}" class="category-item category-item--small category-item--half">
                <span class="category-item__title">Кровати</span>
                <img src="{{ asset('images/content/category_1.png') }}" alt="">
            </a>
            <a href="{{ route('catalog') }}" class="category-item category-item--two--fifths">
                <span class="category-item__title">Продукция</span>
                <img src="{{ asset('images/content/category_3.png') }}" alt="">
            </a>
            <a href="{{ route('catalog') }}" class="category-item category-item--three--fifths">
                <span class="category-item__title">Консоли</span>
                <img src="{{ asset('images/content/category_4.png') }}" alt="">
            </a>
            <a href="{{ route('catalog') }}" class="category-item category-item--three--fifths">
                <span class="category-item__title">Винтажная мебель</span>
                <img src="{{ asset('images/content/category_5.png') }}" alt="">
            </a>
            <a href="{{ route('catalog') }}" class="category-item category-item--small category-item--two--fifths">
                <span class="category-item__title">Шкафы</span>
                <img src="{{ asset('images/content/category_6.png') }}" alt="">
            </a>
            <a href="{{ route('catalog') }}" class="category-item category-item--third">
                <span class="category-item__title">Кресла</span>
                <img src="{{ asset('images/content/category_7.png') }}" alt="">
            </a>
            <a href="{{ route('catalog') }}" class="category-item category-item--small category-item--third">
                <span class="category-item__title">Столы обеденные</span>
                <img src="{{ asset('images/content/category_8.png') }}" alt="">
            </a>
            <a href="{{ route('catalog') }}" class="category-item category-item--third">
                <span class="category-item__title">Комоды, дрессуары, секретеры</span>
                <img src="{{ asset('images/content/category_23.png') }}" alt="">
            </a>
            <a href="{{ route('catalog') }}" class="category-item category-item--two--fifths">
                <span class="category-item__title">Фарфоровая посуда, статуэтки, вазы</span>
                <img src="{{ asset('images/content/category_26.png') }}" alt="">
            </a>
            <a href="{{ route('catalog') }}" class="category-item category-item--three--fifths">
                <span class="category-item__title">Маленькая мебель/разное</span>
                <img src="{{ asset('images/content/category_21.png') }}" alt="">
            </a>
            <a href="{{ route('catalog') }}" class="category-item category-item--third">
                <span class="category-item__title">Столы/консоли</span>
                <img src="{{ asset('images/content/category_3.png') }}" alt="">
            </a>
            <a href="{{ route('catalog') }}" class="category-item category-item--third">
                <span class="category-item__title">Кабинеты</span>
                <img src="{{ asset('images/content/category_6.png') }}" alt="">
            </a>
            <a href="{{ route('catalog') }}" class="category-item category-item--small category-item--third">
                <span class="category-item__title">Столовые</span>
                <img src="{{ asset('images/content/category_10.png') }}" alt="">
            </a>
            <a href="{{ route('catalog') }}" class="category-item category-item--third">
                <span class="category-item__title">Спальни</span>
                <img src="{{ asset('images/content/category_8.png') }}" alt="">
            </a>
        </div>
    </div>
</section>

<x-seo-text>
    {{ $product->name }} - антикварная мебель и предметы интерьера.
    <br><br>
    Если вы поклонник винтажного стиля в интерьере, то создать такую изысканную обстановку у себя
    дома или в заведении не составит труда. Ведь в нашем магазине есть комплекты и предметы мебели,
    чтобы оборудовать настоящие комнаты и любые пространства.
</x-seo-text>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const productSwiper = new Swiper('.product-gallery .product-swiper', {
        spaceBetween: 10,
        pagination: {
            el: '.product-swiper__pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.product-swiper__next',
            prevEl: '.product-swiper__prev',
        },
    });
    
    const thumbsSwiper = new Swiper('.product-gallery .product-thumbs', {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
    });
    
    productSwiper.controller.control = thumbsSwiper;
    thumbsSwiper.controller.control = productSwiper;
    
    const similarSwiper = new Swiper('.similar-swiper .swiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        navigation: {
            nextEl: '.similar-button__next',
            prevEl: '.similar-button__prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 4,
            }
        }
    });
});
</script>
@endpush