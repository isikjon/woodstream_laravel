@extends('layouts.base')

@section('title', $category ? $category->name . ' - WoodStream' : 'Каталог - WoodStream')

@section('content')
<x-breadcrumbs.index :items="[
    ['title' => 'Каталог', 'url' => $category ? route('catalog') : null],
    $category ? ['title' => $category->name] : ['title' => 'Все товары']
]" />

<section class="catalog">
    <div class="container">
        <div class="catalog-grid">
            <form class="catalog-filter" method="GET">
                <div class="catalog-filter__modal">
                    <h3 class="catalog-filter__name">Фильтры</h3>
                    <div class="catalog-filter__close">
                        <img src="{{ asset('images/icons/close.svg') }}" alt="">
                    </div>
                </div>

                <div class="catalog-filter__item catalog-filter__item--active">
                    <div class="catalog-filter__head">
                        <h4 class="catalog-filter__title">Наличие</h4>
                        <span class="catalog-filter__arrow">
                            <img src="{{ asset('images/icons/arrow_down.svg') }}" alt="">
                        </span>
                    </div>
                    <div class="catalog-filter__body">
                        <label class="catalog-filter__label">
                            <input type="checkbox" name="new" value="1" {{ request('new') ? 'checked' : '' }}>
                            <span></span>
                            <p>Новинки</p>
                        </label>
                        <label class="catalog-filter__label">
                            <input type="checkbox" name="status[]" value="available" {{ in_array('available', (array)request('status', [])) ? 'checked' : '' }}>
                            <span></span>
                            <p>В наличии</p>
                        </label>
                        <label class="catalog-filter__label">
                            <input type="checkbox" name="status[]" value="coming_soon" {{ in_array('coming_soon', (array)request('status', [])) ? 'checked' : '' }}>
                            <span></span>
                            <p>Скоро в продаже</p>
                        </label>
                        <label class="catalog-filter__label">
                            <input type="checkbox" name="status[]" value="custom_order" {{ in_array('custom_order', (array)request('status', [])) ? 'checked' : '' }}>
                            <span></span>
                            <p>Под заказ</p>
                        </label>
                        <label class="catalog-filter__label">
                            <input type="checkbox" name="status[]" value="reserved" {{ in_array('reserved', (array)request('status', [])) ? 'checked' : '' }}>
                            <span></span>
                            <p>Забронировано</p>
                        </label>
                        <label class="catalog-filter__label">
                            <input type="checkbox" name="status[]" value="restoration" {{ in_array('restoration', (array)request('status', [])) ? 'checked' : '' }}>
                            <span></span>
                            <p>Под реставрацию</p>
                        </label>
                        <label class="catalog-filter__label">
                            <input type="checkbox" name="status[]" value="sold" {{ in_array('sold', (array)request('status', [])) ? 'checked' : '' }}>
                            <span></span>
                            <p>Продано</p>
                        </label>
                    </div>
                </div>

                @if($cities->isNotEmpty())
                <div class="catalog-filter__item catalog-filter__item--active">
                    <div class="catalog-filter__head">
                        <h4 class="catalog-filter__title">Город наличия</h4>
                        <span class="catalog-filter__arrow">
                            <img src="{{ asset('images/icons/arrow_down.svg') }}" alt="">
                        </span>
                    </div>
                    <div class="catalog-filter__body">
                        @foreach($cities as $city)
                        <label class="catalog-filter__label">
                            <input type="checkbox" name="city[]" value="{{ $city }}" {{ in_array($city, (array)request('city', [])) ? 'checked' : '' }}>
                            <span></span>
                            <p>{{ $city }}</p>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                @if(!$category && $categories->isNotEmpty())
                <div class="catalog-filter__item catalog-filter__item--active">
                    <div class="catalog-filter__head">
                        <h4 class="catalog-filter__title">Категории</h4>
                        <span class="catalog-filter__arrow">
                            <img src="{{ asset('images/icons/arrow_down.svg') }}" alt="">
                        </span>
                    </div>
                    <div class="catalog-filter__body">
                        @foreach($categories as $cat)
                        <label class="catalog-filter__label">
                            <input type="checkbox" name="categories[]" value="{{ $cat->id }}" {{ in_array($cat->id, (array)request('categories', [])) ? 'checked' : '' }}>
                            <span></span>
                            <p>{{ $cat->name }}</p>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($styles->isNotEmpty())
                <div class="catalog-filter__item catalog-filter__item--active">
                    <div class="catalog-filter__head">
                        <h4 class="catalog-filter__title">Стиль</h4>
                        <span class="catalog-filter__arrow">
                            <img src="{{ asset('images/icons/arrow_down.svg') }}" alt="">
                        </span>
                    </div>
                    <div class="catalog-filter__body">
                        @foreach($styles as $style)
                        <label class="catalog-filter__label">
                            <input type="checkbox" name="style[]" value="{{ $style }}" {{ in_array($style, (array)request('style', [])) ? 'checked' : '' }}>
                            <span></span>
                            <p>{{ $style }}</p>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($priceRanges->isNotEmpty())
                <div class="catalog-filter__item catalog-filter__item--active">
                    <div class="catalog-filter__head">
                        <h4 class="catalog-filter__title">Цена</h4>
                        <span class="catalog-filter__arrow">
                            <img src="{{ asset('images/icons/arrow_down.svg') }}" alt="">
                        </span>
                    </div>
                    <div class="catalog-filter__body">
                        @foreach($priceRanges as $range)
                        <label class="catalog-filter__label">
                            <input type="checkbox" name="price_range[]" value="{{ $range['key'] }}" {{ in_array($range['key'], (array)request('price_range', [])) ? 'checked' : '' }}>
                            <span></span>
                            <p>{{ $range['label'] }} <span style="color: #999;">({{ $range['count'] }})</span></p>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($countries->isNotEmpty())
                <div class="catalog-filter__item">
                    <div class="catalog-filter__head">
                        <h4 class="catalog-filter__title">Страна</h4>
                        <span class="catalog-filter__arrow">
                            <img src="{{ asset('images/icons/arrow_down.svg') }}" alt="">
                        </span>
                    </div>
                    <div class="catalog-filter__body">
                        @foreach($countries as $country)
                        <label class="catalog-filter__label">
                            <input type="checkbox" name="country[]" value="{{ $country }}" {{ in_array($country, (array)request('country', [])) ? 'checked' : '' }}>
                            <span></span>
                            <p>{{ $country }}</p>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="catalog-filter__buttons">
                    <button type="submit" class="catalog-filter__apply">Применить</button>
                    <a href="{{ $category ? route('catalog.category', $category->slug) : route('catalog') }}" class="catalog-filter__close">Сбросить</a>
                </div>
            </form>

            <div class="catalog-products">
                <div class="section-top">
                    <h2 class="section-title">
                        {{ $category ? $category->name : 'Все товары' }}
                    </h2>
                    <div class="catalog-count">
                        Найдено: <span>{{ $products->total() }} 
                        @if($products->total() == 1)
                            товар
                        @elseif($products->total() >= 2 && $products->total() <= 4)
                            товара
                        @else
                            товаров
                        @endif
                        </span>
                    </div>
                </div>

                <button class="catalog-filter__opener">
                    Фильтры
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M15.3333 4.58416H13.5093C13.3665 4.05755 13.0542 3.5926 12.6208 3.26111C12.1874 2.92961 11.657 2.75 11.1113 2.75C10.5657 2.75 10.0352 2.92961 9.60182 3.26111C9.16842 3.5926 8.85619 4.05755 8.71333 4.58416H0.666667C0.489856 4.58416 0.320286 4.65439 0.195262 4.77942C0.0702379 4.90444 0 5.07401 0 5.25082C0 5.42763 0.0702379 5.5972 0.195262 5.72223C0.320286 5.84725 0.489856 5.91749 0.666667 5.91749H8.71333C8.85619 6.4441 9.16842 6.90904 9.60182 7.24054C10.0352 7.57203 10.5657 7.75165 11.1113 7.75165C11.657 7.75165 12.1874 7.57203 12.6208 7.24054C13.0542 6.90904 13.3665 6.4441 13.5093 5.91749H15.3333C15.5101 5.91749 15.6797 5.84725 15.8047 5.72223C15.9298 5.5972 16 5.42763 16 5.25082C16 5.07401 15.9298 4.90444 15.8047 4.77942C15.6797 4.65439 15.5101 4.58416 15.3333 4.58416ZM11.1113 6.41749C10.8806 6.41749 10.655 6.34907 10.4632 6.22087C10.2713 6.09268 10.1218 5.91047 10.0335 5.69729C9.94517 5.48411 9.92207 5.24953 9.96708 5.02322C10.0121 4.79691 10.1232 4.58903 10.2864 4.42586C10.4495 4.2627 10.6574 4.15159 10.8837 4.10657C11.11 4.06156 11.3446 4.08466 11.5578 4.17296C11.771 4.26127 11.9532 4.4108 12.0814 4.60266C12.2096 4.79452 12.278 5.02008 12.278 5.25082C12.278 5.56024 12.1551 5.85699 11.9363 6.07578C11.7175 6.29457 11.4208 6.41749 11.1113 6.41749ZM15.3333 10.0842H7.28733C7.14424 9.55767 6.83188 9.0929 6.39845 8.76154C5.96501 8.43018 5.43459 8.25065 4.889 8.25065C4.34341 8.25065 3.81299 8.43018 3.37955 8.76154C2.94612 9.0929 2.63376 9.55767 2.49067 10.0842H0.666667C0.489856 10.0842 0.320286 10.1544 0.195262 10.2794C0.0702379 10.4044 0 10.574 0 10.7508C0 10.9276 0.0702379 11.0972 0.195262 11.2222C0.320286 11.3473 0.489856 11.4175 0.666667 11.4175H2.49067C2.63376 11.944 2.94612 12.4088 3.37955 12.7401C3.81299 13.0715 4.34341 13.251 4.889 13.251C5.43459 13.251 5.96501 13.0715 6.39845 12.7401C6.83188 12.4088 7.14424 11.944 7.28733 11.4175H15.3333C15.5101 11.4175 15.6797 11.3473 15.8047 11.2222C15.9298 11.0972 16 10.9276 16 10.7508C16 10.574 15.9298 10.4044 15.8047 10.2794C15.6797 10.1544 15.5101 10.0842 15.3333 10.0842ZM4.88867 11.9175C4.65792 11.9175 4.43236 11.8491 4.2405 11.7209C4.04864 11.5927 3.89911 11.4105 3.81081 11.1973C3.72251 10.9841 3.6994 10.7495 3.74442 10.5232C3.78943 10.2969 3.90055 10.089 4.06371 9.92587C4.22687 9.76271 4.43475 9.65159 4.66106 9.60658C4.88737 9.56156 5.12195 9.58466 5.33513 9.67297C5.54831 9.76127 5.73052 9.9108 5.85871 10.1027C5.98691 10.2945 6.05533 10.5201 6.05533 10.7508C6.0548 11.0601 5.93172 11.3565 5.71304 11.5752C5.49436 11.7939 5.19792 11.917 4.88867 11.9175Z" fill="#F0F4FF" />
                    </svg>
                </button>

                <div class="catalog-quick">
                    <h2>Быстрые фильтры:</h2>
                    <div class="catalog-quick__filters">
                        <a href="{{ $category ? route('catalog.category', $category->slug) : route('catalog') }}" 
                           class="catalog-quick__filter {{ !request()->hasAny(['status', 'new', 'city', 'categories', 'style', 'century', 'country']) ? 'catalog-quick__filter--active' : '' }}">
                            Все
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => ['available'], 'page' => null]) }}" 
                           class="catalog-quick__filter {{ in_array('available', (array)request('status', [])) ? 'catalog-quick__filter--active' : '' }}">
                            В наличии
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => ['coming_soon'], 'page' => null]) }}" 
                           class="catalog-quick__filter {{ in_array('coming_soon', (array)request('status', [])) ? 'catalog-quick__filter--active' : '' }}">
                            Скоро в наличии
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => ['restoration'], 'page' => null]) }}" 
                           class="catalog-quick__filter {{ in_array('restoration', (array)request('status', [])) ? 'catalog-quick__filter--active' : '' }}">
                            Под реставрацию
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => ['custom_order'], 'page' => null]) }}" 
                           class="catalog-quick__filter {{ in_array('custom_order', (array)request('status', [])) ? 'catalog-quick__filter--active' : '' }}">
                            Под заказ
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => ['sold'], 'page' => null]) }}" 
                           class="catalog-quick__filter {{ in_array('sold', (array)request('status', [])) ? 'catalog-quick__filter--active' : '' }}">
                            Продано
                        </a>
                    </div>
                </div>

                <div class="catalog-products__grid">
                    @forelse($products as $product)
                    <div class="catalog-product">
                        @if($product->special > 0)
                        <span class="catalog-product__discount">Спец. цена</span>
                        @endif
                        <a href="{{ route('product.show', $product->id) }}" class="catalog-product__image {{ $product->availability == 5 ? 'catalog-product__image--sold' : '' }}">
                            <img src="{{ $product->main_image }}" alt="{{ $product->name }}">
                        </a>
                        <div class="catalog-product__content">
                            <div class="catalog-product__info">
                                <span class="catalog-product__code">{{ $product->model ?? 'N/A' }}</span>
                                <p class="catalog-product__status {{ $product->availability == 5 ? 'catalog-product__status--sold' : '' }}">
                                    @if($product->availability == 5)
                                        Продан
                                    @elseif($product->availability == 10)
                                        <img src="{{ asset('images/icons/clock.svg') }}" alt=""> Скоро в продаже
                                    @elseif($product->availability == 8)
                                        Под заказ
                                    @elseif($product->availability == 9)
                                        Забронировано
                                    @elseif($product->availability == 11)
                                        Под реставрацию
                                    @else
                                        <img src="{{ asset('images/icons/check-icon.svg') }}" alt=""> В наличии
                                    @endif
                                </p>
                            </div>
                        <div class="catalog-product__price">
                            @if($product->availability == 5)
                                <span style="color: #999;">Продано</span>
                            @elseif($product->special > 0)
                                {{ number_format($product->special, 0, ',', ' ') }} ₽
                                <div class="catalog-product__old">
                                    <span class="catalog-product__old-price">{{ number_format($product->price, 0, ',', ' ') }} ₽</span>
                                </div>
                            @else
                                {{ number_format($product->price, 0, ',', ' ') }} ₽
                            @endif
                        </div>
                            <h3 class="catalog-product__title">
                                {{ $product->name }}
                            </h3>
                        </div>
                    </div>
                    @empty
                    <div class="catalog-empty" style="grid-column: 1 / -1; text-align: center; padding: 60px 0;">
                        <h3>Товары не найдены</h3>
                        <p>Попробуйте изменить параметры фильтра</p>
                    </div>
                    @endforelse
                </div>

                @if($products->hasPages())
                    <x-pagination :paginator="$products" />
                @endif
                
                <div class="catalog-all">
                    <span>Показать ещё</span>
                </div>
            </div>
        </div>
    </div>
</section>

<x-seo-text>
    Антикварные гостиные, столовые, кабинеты, спальни.
    <br> <br>
    Если вы поклонник винтажного стиля в интерьере, то создать такую изысканную обстановку у себя
    дома или в заведении не составит труда. Ведь в нашем магазине есть комплекты и предметы мебели,
    чтобы оборудовать настоящие комнаты и любые пространства. Винтажная мебель придаст
    эксклюзивности обстановке, подчеркнет вкус владельца и станет его поводом для гордости.
    <br> <br>
    Антикварные комплекты и комнаты – стиль вне времени. Старинные вещи смотрятся стильно и
    оригинально, они шедевральны в своем исполнении. Изысканные линии, незамысловатые очертания,
    резные элементы и бесподобный декор – все это отличает их от современных предметов обстановки. У
    винтажных комплектов мебели есть лицо, у них есть свой характер. Обставить комнату редкими
    вещами – показатель высокого уровня жизни, утонченного вкуса. Если вы ценитель редких,
    антикварных вещей, чувствуете их текстуру и особенность, наслаждаетесь их элегантным видом, то
    обставив интерьер в старинном стиле, вы достигнете высокой степени эстетического удовольствия!
    Антикварные комнаты и комплекты мебели – всегда актуальны и вне времени. Уютные гостиные,
    столовые, кабинеты и ванные комнаты наполнятся особой атмосферой гармонии и элегантности. Такие
    комплекты прекрасно впишутся в концепцию любой квартиры, дома, коммерческого заведения, ведь
    качество, долговечность и эксклюзив всегда в цене!
</x-seo-text>
@endsection

