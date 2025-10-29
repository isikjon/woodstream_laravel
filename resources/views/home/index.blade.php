@extends('layouts.base')

@section('title', 'WoodStream')

@section('content')
<section class="hero">
    <div class="container">
        <div class="hero__block">
            <a href="{{ url('/') }}" class="hero__logo">
                <img src="{{ asset('images/icons/hero_logo.svg') }}" alt="">
            </a>
            <h1 class="hero__title">Антикварная мебель в Москве</h1>
        </div>
        <div class="hero__texts">
            <p class=" hero__text hero__text--left">
                Ателье мебели "Woodstream" начало свою деятельность в 2004 году с производства эксклюзивной,
                качественной мебели ручной работы из натуральной древесины для частных клиентов.
            </p>
            <p class="hero__text hero__text--right">
                Наша студия мебели - это не только производство новой мебели для дома и HoReCa, но и продажа
                винтажной и антикварной мебели и предметов интерьера (часов, картин, изделий из бронзы и
                фарфора, люстр) из Европы (Бельгия, Голландия, Франция, Англия, Португалия, Италия).
            </p>
        </div>
    </div>
</section>

<section class="category">
    <div class="container">
        <div class="section-top">
            <h2 class="section-title">Категории</h2>
            <a href="{{ route('catalog') }}" class="go-page">
                Перейти в каталог
                <img src="{{ asset('images/icons/arrow_right.svg') }}" alt="">
            </a>
        </div>
        <div class="category-block">
            <a href="{{ route('catalog.category', 'shkafy') }}" class="category-item category-item--half category-item--cabinets">
                <span class="category-item__title">Шкафы</span>
                <img src="{{ asset('images/content/category_1.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'myagkaya-mebel') }}"
                class="category-item category-item--small category-item--two--fifths category-item--furniture">
                <span class="category-item__title">Мягкая <br> мебель</span>
                <img src="{{ asset('images/content/category_2.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'stoly-konsoli') }}" class="category-item category-item--three--fifths category-item--tables">
                <span class="category-item__title">Столы,<br> консоли</span>
                <img src="{{ asset('images/content/category_3.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'bufety') }}" class="category-item category-item--half category-item--buffets">
                <span class="category-item__title">Буфеты</span>
                <img src="{{ asset('images/content/category_4.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'vitriny') }}" class="category-item category-item--three--fifths category-item--vitrines">
                <span class="category-item__title">Витрины</span>
                <img src="{{ asset('images/content/category_5.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'kabinety') }}"
                class="category-item category-item--small category-item--two--fifths category-item--offices">
                <span class="category-item__title">Кабинеты</span>
                <img src="{{ asset('images/content/category_6.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'antikvarnaya-mebel-skidki') }}" class="category-item category-item--half category-item--discount">
                <span class="category-item__title">Антикварная <br> мебель <br> Скидки</span>
                <img src="{{ asset('images/content/category_7.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'spalni') }}"
                class="category-item category-item--small category-item--third category-item--bedrooms">
                <span class="category-item__title">Спальни</span>
                <img src="{{ asset('images/content/category_8.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'osveshchenie') }}" class="category-item category-item--two--fifths category-item--lights">
                <span class="category-item__title">Освещение</span>
                <img src="{{ asset('images/content/category_9.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'stolovye') }}" class="category-item category-item--three--fifths category-item--dinning">
                <span class="category-item__title">Столовые</span>
                <img src="{{ asset('images/content/category_10.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'zerkala-konsoli') }}" class="category-item category-item--third category-item--mirrors">
                <span class="category-item__title">Зеркала, <br> консоли</span>
                <img src="{{ asset('images/content/category_11.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'chasy') }}" class="category-item category-item--third category-item--watches">
                <span class="category-item__title">Часы</span>
                <img src="{{ asset('images/content/category_12.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'kaminy-pechi') }}" class="category-item category-item--third category-item--stoves">
                <span class="category-item__title">Камины, <br> печи</span>
                <img src="{{ asset('images/content/category_13.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'skulptury') }}"
                class="category-item category-item--small category-item--third category-item--sculptures">
                <span class="category-item__title">Скульп- <br>туры</span>
                <img src="{{ asset('images/content/category_14.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'komplekty-komnaty') }}" class="category-item category-item--third category-item--rooms">
                <span class="category-item__title">Комплекты, <br> комнаты</span>
                <img src="{{ asset('images/content/category_15.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'podarki') }}"
                class="category-item category-item--small category-item--two--fifths category-item--gifts">
                <span class="category-item__title">Подарки</span>
                <img src="{{ asset('images/content/category_16.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'tekstil-odezhda') }}" class="category-item category-item--third category-item--clothes">
                <span class="category-item__title">Текстиль, <br>одежда</span>
                <img src="{{ asset('images/content/category_17.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'kartiny-gobeleny') }}" class="category-item category-item--two--fifths category-item--paintings">
                <span class="category-item__title">Картины/ <br> Гобелены</span>
                <img src="{{ asset('images/content/category_18.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'mebel-shinuazri') }}" class="category-item category-item--two--fifths category-item--chinoise">
                <span class="category-item__title">Мебель <br> шинуазри</span>
                <img src="{{ asset('images/content/category_19.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'prihozhie') }}"
                class="category-item category-item--small category-item--third category-item--hallway">
                <span class="category-item__title">Прихожие</span>
                <img src="{{ asset('images/content/category_20.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'malenkaya-mebel-raznoe') }}" class="category-item category-item--half category-item--small-mabel">
                <span class="category-item__title">Маленькая <br> мебель/ <br>разное</span>
                <img src="{{ asset('images/content/category_21.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'raznoe') }}"
                class="category-item category-item--small category-item--third category-item--other">
                <span class="category-item__title">Разное</span>
                <img src="{{ asset('images/content/category_22.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'komody-dressuary-sekretery') }}"
                class="category-item category-item--big category-item--three--fifths category-item--chests">
                <span class="category-item__title">Комоды, <br> дрессуары, <br> секретеры</span>
                <img src="{{ asset('images/content/category_23.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'kukly-vintazhnye') }}"
                class="category-item category-item--bigger category-item--three--fifths category-item--toys">
                <span class="category-item__title">Куклы <br> винтажные</span>
                <img src="{{ asset('images/content/category_24.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'starinnaya-mebel-v-nalichii-v-rossii') }}"
                class="category-item category-item--bigger category-item--three--fifths category-item--antiques">
                <span class="category-item__title">Старинная <br> мебель в наличии <br> в России</span>
                <img src="{{ asset('images/content/category_25.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'farforovaya-posuda-statuetki-vazy') }}"
                class="category-item category-item--big category-item--three--fifths category-item--vases">
                <span class="category-item__title">Фарфоровая <br> посуда, <br> статуэтки, вазы</span>
                <img src="{{ asset('images/content/category_26.png') }}" alt="">
            </a>
            <a href="{{ route('catalog.category', 'prodano-arhiv') }}"
                class="category-item category-item--small category-item--two--fifths category-item--archive">
                <span class="category-item__title">Продано, <br> архив</span>
                <img src="{{ asset('images/content/category_27.png') }}" alt="">
            </a>
        </div>
    </div>
</section>

<section class="antique">
    <div class="container">
        <div class="antique-grid">
            <div class="antique-infos">
                <h2 class="section-title">Магазин антикварной старинной мебели - Вудстрим</h2>
                <p class="antique-text">
                    ВУДСТРИМ — это большой склад старинной мебели в Москве. <br> <br>
                    Каждую неделю мы привозим из Европы 100+ единиц мебели. Публикуем на нашем сайте,
                    в телеграм канале и инстаграм. <br> <br>
                    Регистрируйтесь на нашем сайте. <br> <br>
                    Пишите нашим менеджерам в <a href="#">Whatsapp</a> и Директ, и узнавайте о новинках
                    первыми.
                </p>
            </div>
            <div class="antique-swiper ">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="antique-item">
                                <a href="#" class="antique-item__image">
                                    <img src="{{ asset('images/content/antique_1.png') }}" alt="">
                                </a>
                                <div class="antique-item__content">
                                    <div class="antique-item__info">
                                        <span class="antique-item__code">Арт-И24211</span>
                                        <p class="antique-item__status"><img
                                                src="{{ asset('images/icons/check-icon.svg') }}" alt=""> В наличии</p>
                                    </div>
                                    <div class="antique-item__price">
                                        160 000 ₽
                                    </div>
                                    <h3 class="antique-item__title">Шкаф в стиле шинуазри</h3>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="antique-item">
                                <a href="#" class="antique-item__image">
                                    <img src="{{ asset('images/content/antique_2.png') }}" alt="">
                                </a>
                                <div class="antique-item__content">
                                    <div class="antique-item__info">
                                        <span class="antique-item__code">Арт-И24211</span>
                                        <p class="antique-item__status"><img
                                                src="{{ asset('images/icons/check-icon.svg') }}" alt=""> В наличии</p>
                                    </div>
                                    <div class="antique-item__price">
                                        160 000 ₽
                                    </div>
                                    <h3 class="antique-item__title">Шкаф в стиле шинуазри</h3>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="antique-item">
                                <a href="#" class="antique-item__image">
                                    <img src="{{ asset('images/content/antique_3.png') }}" alt="">
                                </a>
                                <div class="antique-item__content">
                                    <div class="antique-item__info">
                                        <span class="antique-item__code">Арт-И24211</span>
                                        <p class="antique-item__status"><img
                                                src="{{ asset('images/icons/check-icon.svg') }}" alt=""> В наличии</p>
                                    </div>
                                    <div class="antique-item__price">
                                        160 000 ₽
                                    </div>
                                    <h3 class="antique-item__title">Шкаф в стиле шинуазри</h3>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="antique-item">
                                <a href="#" class="antique-item__image">
                                    <img src="{{ asset('images/content/antique_1.png') }}" alt="">
                                </a>
                                <div class="antique-item__content">
                                    <div class="antique-item__info">
                                        <span class="antique-item__code">Арт-И24211</span>
                                        <p class="antique-item__status"><img
                                                src="{{ asset('images/icons/check-icon.svg') }}" alt=""> В наличии</p>
                                    </div>
                                    <div class="antique-item__price">
                                        160 000 ₽
                                    </div>
                                    <h3 class="antique-item__title">Шкаф в стиле шинуазри</h3>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="antique-item">
                                <a href="#" class="antique-item__image">
                                    <img src="{{ asset('images/content/antique_2.png') }}" alt="">
                                </a>
                                <div class="antique-item__content">
                                    <div class="antique-item__info">
                                        <span class="antique-item__code">Арт-И24211</span>
                                        <p class="antique-item__status"><img
                                                src="{{ asset('images/icons/check-icon.svg') }}" alt=""> В наличии</p>
                                    </div>
                                    <div class="antique-item__price">
                                        160 000 ₽
                                    </div>
                                    <h3 class="antique-item__title">Шкаф в стиле шинуазри</h3>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="antique-item">
                                <a href="#" class="antique-item__image">
                                    <img src="{{ asset('images/content/antique_3.png') }}" alt="">
                                </a>
                                <div class="antique-item__content">
                                    <div class="antique-item__info">
                                        <span class="antique-item__code">Арт-И24211</span>
                                        <p class="antique-item__status"><img
                                                src="{{ asset('images/icons/check-icon.svg') }}" alt=""> В наличии</p>
                                    </div>
                                    <div class="antique-item__price">
                                        160 000 ₽
                                    </div>
                                    <h3 class="antique-item__title">Шкаф в стиле шинуазри</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next antique-button__next">
                    <img src="{{ asset('images/icons/slider-right.svg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="weekly">
    <div class="container">
        <h2 class="section-title">Новинки недели</h2>
        <div class="weekly-grid">
            @foreach($weeklyProducts as $product)
            <div class="weekly-product">
                <div class="weekly-product__image">
                    <img src="{{ $product->main_image }}" alt="{{ $product->name }}">
                </div>
                @if($product->special > 0)
                    <span class="weekly-product__type">Спец. цена</span>
                @elseif($product->priority > 0)
                <span class="weekly-product__type">Новинка</span>
                @endif
                <div class="weekly-product__content">
                    <div class="weekly-product__info">
                        <span class="weekly-product__code">{{ $product->model ?? 'N/A' }}</span>
                        <p class="weekly-product__status">
                            <img src="{{ asset('images/icons/check-icon.svg') }}" alt=""> 
                            @if($product->availability == 5)
                                Продан
                            @elseif($product->availability == 10)
                                Скоро в продаже
                            @elseif($product->availability == 8)
                                Под заказ
                            @else
                                В наличии
                            @endif
                        </p>
                    </div>
                    <div class="weekly-product__price">
                        @if($product->special > 0)
                            {{ number_format($product->special, 0, ',', ' ') }} ₽
                        @else
                        {{ number_format($product->price, 0, ',', ' ') }} ₽
                        @endif
                    </div>
                    <h3 class="weekly-product__title">{{ $product->name }}</h3>
                </div>
            </div>
            @endforeach
        </div>
        <button class="weekly-all">
            <span>Показать ещё</span>
            <img src="{{ asset('images/icons/arrow_down.svg') }}" alt="">
        </button>
    </div>
</section>

<section class="blog">
    <div class="container">
        <div class="section-top">
            <h2 class="section-title">Блог</h2>
            <a href="{{ route('blog') }}" class="go-page">
                Перейти в блог
                <img src="{{ asset('images/icons/arrow_right.svg') }}" alt="">
            </a>
        </div>
        <div class="blog-grid">
            @foreach($blogs as $blog)
            <div class="blog-item">
                <a href="{{ route('blog.show', $blog->slug) }}" class="blog-item__image">
                    <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}">
                </a>
                <div class="blog-item__content">
                    <span class="blog-item__tags">
                        {{ $blog->tags }}
                    </span>
                    <a href="{{ route('blog.show', $blog->slug) }}">
                        <h3 class="blog-item__name">{{ $blog->title }}</h3>
                    </a>
                    <p class="blog-item__text">
                        {{ $blog->excerpt }}
                    </p>
                    <div class="blog-item__date">
                        @if($blog->published_at)
                            {{ $blog->published_at->format('d.m.Y') }}
                        @elseif($blog->created_at)
                            {{ $blog->created_at->format('d.m.Y') }}
                        @else
                            {{ now()->format('d.m.Y') }}
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="interior">
    <div class="container">
        <h2 class="section-title">Антикварная мебель фото - в интерьере</h2>
        <div class="interior-swiper">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="interior-item">
                            <a href="#" class="interior-item__image">
                                <img src="{{ asset('images/content/interior-1.png') }}" alt="">
                            </a>
                            <span class="interior-item__name">Стол Silik</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="interior-item">
                            <a href="#" class="interior-item__image">
                                <img src="{{ asset('images/content/interior-2.png') }}" alt="">
                            </a>
                            <span class="interior-item__name">Витрина и часы</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="interior-item">
                            <a href="#" class="interior-item__image">
                                <img src="{{ asset('images/content/interior-3.png') }}" alt="">
                            </a>
                            <span class="interior-item__name">Кресло</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="interior-item">
                            <a href="#" class="interior-item__image">
                                <img src="{{ asset('images/content/interior-4.png') }}" alt="">
                            </a>
                            <span class="interior-item__name">Секретер</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="interior-item">
                            <a href="#" class="interior-item__image">
                                <img src="{{ asset('images/content/interior-5.png') }}" alt="">
                            </a>
                            <span class="interior-item__name">Комод Бомбе</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="interior-item">
                            <a href="#" class="interior-item__image">
                                <img src="{{ asset('images/content/interior-6.png') }}" alt="">
                            </a>
                            <span class="interior-item__name">Наполный светильник</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="interior-item">
                            <a href="#" class="interior-item__image">
                                <img src="{{ asset('images/content/interior-7.png') }}" alt="">
                            </a>
                            <span class="interior-item__name">Подсвечник</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="interior-item">
                            <a href="#" class="interior-item__image">
                                <img src="{{ asset('images/content/interior-8.png') }}" alt="">
                            </a>
                            <span class="interior-item__name">Бра</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="interior-item">
                            <a href="#" class="interior-item__image">
                                <img src="{{ asset('images/content/interior-1.png') }}" alt="">
                            </a>
                            <span class="interior-item__name">Стол Silik</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="interior-item">
                            <a href="#" class="interior-item__image">
                                <img src="{{ asset('images/content/interior-2.png') }}" alt="">
                            </a>
                            <span class="interior-item__name">Витрина и часы</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="interior-item">
                            <a href="#" class="interior-item__image">
                                <img src="{{ asset('images/content/interior-3.png') }}" alt="">
                            </a>
                            <span class="interior-item__name">Кресло</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="interior-item">
                            <a href="#" class="interior-item__image">
                                <img src="{{ asset('images/content/interior-4.png') }}" alt="">
                            </a>
                            <span class="interior-item__name">Секретер</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="interior-item">
                            <a href="#" class="interior-item__image">
                                <img src="{{ asset('images/content/interior-5.png') }}" alt="">
                            </a>
                            <span class="interior-item__name">Комод Бомбе</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="interior-item">
                            <a href="#" class="interior-item__image">
                                <img src="{{ asset('images/content/interior-6.png') }}" alt="">
                            </a>
                            <span class="interior-item__name">Наполный светильник</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="interior-item">
                            <a href="#" class="interior-item__image">
                                <img src="{{ asset('images/content/interior-7.png') }}" alt="">
                            </a>
                            <span class="interior-item__name">Подсвечник</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="interior-item">
                            <a href="#" class="interior-item__image">
                                <img src="{{ asset('images/content/interior-8.png') }}" alt="">
                            </a>
                            <span class="interior-item__name">Бра</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next interior-button__next">
                <img src="{{ asset('images/icons/slider-right.svg') }}" alt="">
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
