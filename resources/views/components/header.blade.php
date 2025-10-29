<style>
    .header {
        position: relative !important;
    }
    .header__nav-dropdown-list-new-menu {
        display: none; 
        gap: 5px; 
        color: #000; 
        justify-content: space-between; 
        width: 100%;
        position: absolute !important;
        top: 100% !important;
        left: 0 !important;
        width: 100% !important;
        background-color: #fff !important;
        border-radius: 8px !important;
        z-index: 1000 !important;
        box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1) !important;
    }
    .header__nav-dropdown-item-new-menu {
        color: #1d2229;
        font-size: 14px;
        font-style: normal;
        font-weight: 500;
        line-height: 140%;
    }
    .header__nav-dropdown-item-new-menu:hover {
        opacity: 0.8;
    }
    .header__nav-more:hover .header__nav-dropdown-list-new-menu {
        display: flex;
    }
</style>
<header class="header">
    <div class="container">
        <div class="header__top">
            <div class="header__info">
                <nav>
                    <a href="{{ route('catalog', ['status' => ['available']]) }}" class="header__link">В наличии в России</a>
                    <a href="{{ route('catalog', ['status' => ['available']]) }}" class="header__link header__link-discount">% Скидки</a>
                    <a href="{{ route('blog') }}" class="header__link">Блог</a>
                    <a href="{{ route('reviews') }}" class="header__link">Отзывы</a>
                            <a href="{{ route('contacts') }}" class="header__link">Контакты</a>
                </nav>
                <div class="header__theme">
                    <span class="header__theme-text">Выбрать тему:</span>
                    <img src="{{ asset('images/icons/Light.svg') }}" alt="">
                    <span class="header__theme-mode">Светлая</span>
                </div>
            </div>
            <div class="header__contacts">
                <a href="mailto:info@woodstream.online" class="header__email">
                    <img src="{{ asset('images/icons/mail.svg') }}" alt="">
                    info@woodstream.online</a>
                        <div class="header__socials">
                            <span>Чаты и соц. сети:</span>
                            <x-social-links class="header__socials-links" />
                        </div>
            </div>
        </div>
        <div class="header__main">
            <a href="{{ route('home') }}" class="header__logo" aria-label="Перейти на главную страницу">
                <img src="{{ asset('images/icons/logo.svg') }}" alt="Woodstream" class="header__logo-img">
            </a>
            <div class="header__actions">
                <a href="{{ route('home') }}" class="header__home" aria-label="Перейти на главную страницу"><img
                        src="{{ asset('images/icons/home.svg') }}" alt=""></a>
                <a href="{{ route('catalog') }}" class="header__catalog">Каталог</a>
                <form class="header__search">
                    <button><img src="{{ asset('images/icons/search.svg') }}" alt=""></button>
                    <input type="text" class="header__search-input" placeholder="Поиск по товарам"
                        aria-label="Поиск по товарам">
                </form>
            </div>
            <a href="#" class="header__burger">
                <img src="{{ asset('images/icons/burger.svg') }}" alt="">
            </a>
            <div class="header__phone">
                <x-duty-phone class="header__phone-link" />
                <span class="header__phone-time">
                    <img src="{{ asset('images/icons/phone.svg') }}" alt="">Ежедневно 24/7</span>
            </div>
            <a href="#" class="header__login">
                <img src="{{ asset('images/icons/log_out.svg') }}" alt="">
                Вход</a>
        </div>
        <nav class="header__nav">
            <a href="{{ route('catalog') }}" class="header__nav-item header__nav-item--active">Новинка</a>
            <a href="{{ route('catalog.category', 'vintazhnye-shkafy-bufety-vitriny') }}" class="header__nav-item">Шкафы</a>
            <a href="{{ route('catalog.category', 'bufeti') }}" class="header__nav-item">Буфеты</a>
            <a href="{{ route('catalog.category', 'vitrini') }}" class="header__nav-item">Витрины</a>
            <a href="{{ route('catalog.category', 'myagkaya-mebel-i-stulya') }}" class="header__nav-item">Мягкая мебель</a>
            <a href="{{ route('catalog.category', 'spalni') }}" class="header__nav-item">Спальни</a>
            <a href="{{ route('catalog.category', 'kabinet') }}" class="header__nav-item">Кабинеты</a>
            <a href="{{ route('catalog.category', 'osveshenie') }}" class="header__nav-item">Освещение</a>
            <a href="{{ route('catalog.category', 'stoly-konsoli') }}" class="header__nav-item">Столы</a>
            <a href="{{ route('catalog.category', 'zerkala-konsoli') }}" class="header__nav-item">Зеркала</a>
            <div class="header__nav-dropdown">
                <button class="header__nav-more">
                    Ещё
                    <img src="{{ asset('images/icons/arrow_down.svg') }}" alt="">
                </button>
            </div>
        </nav>
        <nav class="header__nav-dropdown-list-new-menu">
                    <a href="{{ route('catalog.category', 'podarki') }}" class="header__nav-dropdown-item-new-menu">Подарки</a>
                    <a href="{{ route('catalog.category', 'v-nalichii-v-rossii') }}" class="header__nav-dropdown-item-new-menu">Старинная мебель</a>
                    <a href="{{ route('catalog.category', 'skidki') }}" class="header__nav-dropdown-item-new-menu">Антикварная мебель</a>
                    <a href="{{ route('catalog.category', 'komplekty-komnaty') }}" class="header__nav-dropdown-item-new-menu">Комплекты, комнат</a>
                    <a href="{{ route('catalog.category', 'chasy') }}" class="header__nav-dropdown-item-new-menu">Часы</a>
                    <a href="{{ route('catalog.category', 'kamin-kupit') }}" class="header__nav-dropdown-item-new-menu">Камины/Печи</a>
                    <a href="{{ route('catalog.category', 'Prihozhie') }}" class="header__nav-dropdown-item-new-menu">Прихожие</a>
                    <a href="{{ route('catalog.category', 'vintag-doll') }}" class="header__nav-dropdown-item-new-menu">Куклы винтажные</a>
                    <a href="{{ route('catalog.category', 'Skulptury') }}" class="header__nav-dropdown-item-new-menu">Скульптуры</a>
                    <a href="{{ route('catalog.category', 'Textil') }}" class="header__nav-dropdown-item-new-menu">Текстиль/одежда</a>
                    <a href="{{ route('catalog.category', 'raznoe') }}" class="header__nav-dropdown-item-new-menu">Разное</a>
                    <a href="{{ route('catalog.category', 'kartiny-gobeleny') }}" class="header__nav-dropdown-item-new-menu">Картины</a>
                    <a href="{{ route('catalog.category', 'prodano-arhiv') }}" class="header__nav-dropdown-item-new-menu">Продано/Архив</a>
        </nav>
    </div>
    <div class="header-catalog__modal">
        <section class="category">
            <div class="container">
                <div class="header-catalog__modal-top">
                    <h2 class="section-title">Каталог</h2>
                    <a href="#" class="header-catalog__modal-close" aria-label="Закрыть каталог">
                        <img src="{{ asset('images/icons/close.svg') }}" alt="">
                    </a>
                </div>
                <div class="category-block">
                    <a href="{{ route('catalog.category', 'vintazhnye-shkafy-bufety-vitriny') }}" class="category-item category-item--half category-item--cabinets">
                        <span class="category-item__title">Шкафы</span>
                        <img src="{{ asset('images/content/category_1.png') }}" alt="">
                    </a>
                    <a href="{{ route('catalog.category', 'myagkaya-mebel-i-stulya') }}"
                        class="category-item category-item--small category-item--two--fifths category-item--furniture">
                        <span class="category-item__title">Мягкая <br> мебель</span>
                        <img src="{{ asset('images/content/category_2.png') }}" alt="">
                    </a>
                    <a href="{{ route('catalog.category', 'stoly-konsoli') }}" class="category-item category-item--three--fifths category-item--tables">
                        <span class="category-item__title">Столы,<br> консоли</span>
                        <img src="{{ asset('images/content/category_3.png') }}" alt="">
                    </a>
                    <a href="{{ route('catalog.category', 'bufeti') }}" class="category-item category-item--half category-item--buffets">
                        <span class="category-item__title">Буфеты</span>
                        <img src="{{ asset('images/content/category_4.png') }}" alt="">
                    </a>
                    <a href="{{ route('catalog.category', 'vitrini') }}" class="category-item category-item--three--fifths category-item--vitrines">
                        <span class="category-item__title">Витрины</span>
                        <img src="{{ asset('images/content/category_5.png') }}" alt="">
                    </a>
                    <a href="{{ route('catalog.category', 'kabinet') }}"
                        class="category-item category-item--small category-item--two--fifths category-item--offices">
                        <span class="category-item__title">Кабинеты</span>
                        <img src="{{ asset('images/content/category_6.png') }}" alt="">
                    </a>
                    <a href="{{ route('catalog.category', 'skidki') }}" class="category-item category-item--half category-item--discount">
                        <span class="category-item__title">Антикварная <br> мебель <br> Скидки</span>
                        <img src="{{ asset('images/content/category_7.png') }}" alt="">
                    </a>
                    <a href="{{ route('catalog.category', 'spalni') }}"
                        class="category-item category-item--small category-item--third category-item--bedrooms">
                        <span class="category-item__title">Спальни</span>
                        <img src="{{ asset('images/content/category_8.png') }}" alt="">
                    </a>
                    <a href="{{ route('catalog.category', 'osveshenie') }}" class="category-item category-item--two--fifths category-item--lights">
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
                    <a href="{{ route('catalog.category', 'kamin-kupit') }}" class="category-item category-item--third category-item--stoves">
                        <span class="category-item__title">Камины, <br> печи</span>
                        <img src="{{ asset('images/content/category_13.png') }}" alt="">
                    </a>
                    <a href="{{ route('catalog.category', 'Skulptury') }}"
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
                    <a href="{{ route('catalog.category', 'Textil') }}" class="category-item category-item--third category-item--clothes">
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
                    <a href="{{ route('catalog.category', 'Prihozhie') }}"
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
                    <a href="{{ route('catalog.category', 'dressuary-sekretery') }}"
                        class="category-item category-item--big category-item--three--fifths category-item--chests">
                        <span class="category-item__title">Комоды, <br> дрессуары, <br> секретеры</span>
                        <img src="{{ asset('images/content/category_23.png') }}" alt="">
                    </a>
                    <a href="{{ route('catalog.category', 'vintag-doll') }}"
                        class="category-item category-item--bigger category-item--three--fifths category-item--toys">
                        <span class="category-item__title">Куклы <br> винтажные</span>
                        <img src="{{ asset('images/content/category_24.png') }}" alt="">
                    </a>
                    <a href="{{ route('catalog.category', 'v-nalichii-v-rossii') }}"
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
    </div>
    <div class="header-menu ">
        <div class="container">
            <div class="header-menu__top">
                <h2 class="section-title">Меню</h2>
                <a href="#" class="header-menu__close">
                    <img src="{{ asset('images/icons/close.svg') }}" alt="">
                </a>
            </div>
            <div class="header-menu__contacts">
                        <div class="header-menu__contacts-item header-menu__contacts-item--social">
                            <span>Чаты и соц. сети:</span>
                            <div class="header-menu__contacts-links">
                                <x-social-links class="header-menu__socials" />
                            </div>
                        </div>
                <div class="header-menu__contacts-item header-menu__contacts-item--theme">
                    <span>Выбрать тему:</span>
                    <div class="header-menu__contacts-theme">
                        <img src="{{ asset('images/icons/light.svg') }}" alt="">
                        <span>Светлая</span>
                    </div>
                </div>
                <div class="header-menu__contacts-item">
                    <span>Звоните:</span>
                    <x-contacts-list tag="ul" class="header-menu__phones" />
                </div>
                <div class="header-menu__contacts-item">
                    <span>Пишите:</span>
                    <a href="mailto:info@woodstream.online"
                        class="header__email-link">info@woodstream.online</a>
                    <span class="header__email-time">
                        <img src="{{ asset('images/icons/mail.svg') }}" alt="">
                        По будням
                    </span>
                </div>
            </div>
            <div class="header-menu__links">
                <div class="header-menu__item">
                    <h3>Услуги:</h3>
                    <ul>
                                <li><a href="{{ route('repair') }}">Реставрация и ремонт мебели</a></li>
                        <li><a href="{{ route('restaurant') }}">Старинная и антикварная мебель на заказ для ресторанов</a></li>
                        <li><a href="{{ route('restaurant') }}">Мебель для ресторанов и бутиков</a></li>
                    </ul>
                </div>
                <div class="header-menu__grid">
                    <div class="header-menu__side">
                        <div class="header-menu__item">
                            <h3>Информация</h3>
                            <ul>
                                <li><a href="{{ route('about') }}">О нас</a></li>
                                <li><a href="{{ route('blog') }}">Блог</a></li>
                                <li><a href="{{ route('reviews') }}" class="header__link">Отзывы</a></li>
                                        <li><a href="{{ route('online') }}">Онлайн-закупки на сайте</a></li>
                            </ul>
                        </div>
                        <div class="header-menu__item">
                            <h3>Разное:</h3>
                            <ul>
                                <li><a href="{{ route('designers') }}">Дизайнерам</a></li>
                                <li><a href="#" class="header__link">% Скидки</a></li>
                            </ul>
                        </div>
                        <div class="header-menu__item">
                            <h3>Оплата и доставка:</h3>
                            <ul>
                                <li><a href="{{ route('order') }}">Как сделать заказ?</a></li>
                                        <li><a href="{{ route('delivery') }}">Доставка</a></li>
                                        <li><a href="{{ route('contacts') }}">Контакты</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="header-menu__side">
                        <div class="header-menu__item">
                            <h3>Каталог:</h3>
                            <ul>
                                <li><a href="{{ route('catalog') }}">Новинки</a></li>
                                <li><a href="{{ route('catalog.category', 'vintazhnye-shkafy-bufety-vitriny') }}">Шкафы</a></li>
                                <li><a href="{{ route('catalog.category', 'bufeti') }}">Буфеты</a></li>
                                <li><a href="{{ route('catalog.category', 'vitrini') }}">Витрины</a></li>
                                <li><a href="{{ route('catalog.category', 'myagkaya-mebel-i-stulya') }}">Мягкая мебель</a></li>
                                <li><a href="{{ route('catalog.category', 'spalni') }}">Спальни</a></li>
                                <li><a href="{{ route('catalog.category', 'kabinet') }}">Кабинеты</a></li>
                                <li><a href="{{ route('catalog.category', 'zerkala-konsoli') }}">Зеркала</a></li>
                                <li><a href="{{ route('catalog.category', 'chasy') }}">Часы</a></li>
                                <li><a href="{{ route('catalog.category', 'Textil') }}">Текстиль, одежда</a></li>
                                <li><a href="{{ route('catalog.category', 'raznoe') }}">Разное</a></li>
                                <li><a href="{{ route('catalog.category', 'Prihozhie') }}">Прихожие</a></li>
                                <li><a href="{{ route('catalog.category', 'prodano-arhiv') }}">Продано, архив</a></li>
                                <li><a href="{{ route('catalog') }}">В каталог <img src="{{ asset('images/icons/arrow_right.svg') }}" alt=""></a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

