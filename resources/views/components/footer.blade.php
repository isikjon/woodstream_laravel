<footer class="footer">
    <div class="footer-accordion">
        <div class="footer-accordion__item">
            <div class="footer-accordion__header">
                <h4 class="footer-accordion__title">
                    Услуги
                </h4>
                <span class="footer-accordion__arrow">
                    <img src="{{ asset('images/icons/arrow_down.svg') }}" alt="">
                </span>
            </div>
            <div class="footer-accordion__body">
                <ul>
                    <li><a href="{{ route('repair') }}">Реставрация и ремонт мебели</a></li>
                    <li><a href="{{ route('restaurant') }}">Старинная и антикварная мебель на заказ для ресторанов</a>
                    </li>
                    <li><a href="{{ route('restaurant') }}">Мебель для ресторанов и бутиков</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-accordion__item">
            <div class="footer-accordion__header">
                <h4 class="footer-accordion__title">
                    Информация
                </h4>
                <span class="footer-accordion__arrow">
                    <img src="{{ asset('images/icons/arrow_down.svg') }}" alt="">
                </span>
            </div>
            <div class="footer-accordion__body">
                <ul>
                    <li><a href="{{ route('about') }}">О нас</a></li>
                    <li><a href="{{ route('blog') }}">Блог</a></li>
                    <li><a href="{{ route('reviews') }}" class="footer-columns__link">Отзывы</a></li>
                            <li><a href="{{ route('online') }}">Онлайн-закупки на сайте</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-accordion__item">
            <div class="footer-accordion__header">
                <h4 class="footer-accordion__title">
                    Каталог
                </h4>
                <span class="footer-accordion__arrow">
                    <img src="{{ asset('images/icons/arrow_down.svg') }}" alt="">
                </span>
            </div>
            <div class="footer-accordion__body">
                <ul>
                    <li><a href="{{ route('catalog.category', 'vintazhnye-shkafy-bufety-vitriny') }}">Шкафы</a></li>
                    <li><a href="{{ route('catalog.category', 'bufeti') }}">Буфеты</a></li>
                    <li><a href="{{ route('catalog.category', 'vitrini') }}">Витрины</a></li>
                    <li><a href="{{ route('catalog.category', 'myagkaya-mebel-i-stulya') }}">Мягкая мебель</a></li>
                    <li><a href="{{ route('catalog.category', 'spalni') }}">Спальни</a></li>
                    <li><a href="{{ route('catalog.category', 'kabinet') }}">Кабинеты</a></li>
                    <li><a href="{{ route('catalog.category', 'zerkala-konsoli') }}">Зеркала</a></li>
                    <li><a href="{{ route('catalog.category', 'chasy') }}">Часы</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-accordion__item">
            <div class="footer-accordion__header">
                <h4 class="footer-accordion__title">
                    Оплата и доставка
                </h4>
                <span class="footer-accordion__arrow">
                    <img src="{{ asset('images/icons/arrow_down.svg') }}" alt="">
                </span>
            </div>
            <div class="footer-accordion__body">
                <ul>
                    <li><a href="{{ route('order') }}">Оплата</a></li>
                    <li><a href="{{ route('delivery') }}">Доставка</a></li>
                    <li><a href="#" class="footer-columns__link">Возврат</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-accordion__item">
            <div class="footer-accordion__header">
                <h4 class="footer-accordion__title">
                    Разное
                </h4>
                <span class="footer-accordion__arrow">
                    <img src="{{ asset('images/icons/arrow_down.svg') }}" alt="">
                </span>
            </div>
            <div class="footer-accordion__body">
                <ul>
                    <li><a href="{{ route('designers') }}">Дизайнерам</a></li>
                    <li><a href="#" class="footer-columns__link">% Скидки</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-top">
        <div class="container">
            <div class="footer-columns">
                <div class="footer-columns__side footer-columns__side--left">
                    <div class="footer-columns__column">
                        <h4 class="footer-columns__title">Информация:</h4>
                        <ul class="footer-columns__list">
                            <li class="footer-columns__item">
                                <a href="{{ route('about') }}" class="footer-columns__link">О нас</a>
                            </li>
                            <li class="footer-columns__item"><a href="{{ route('blog') }}" class="footer-columns__link">Блог</a>
                            </li>
                            <li class="footer-columns__item"><a href="{{ route('reviews') }}" class="footer-columns__link">Отзывы</a>
                            </li>
                            <li class="footer-columns__item">
                                <a href="{{ route('online') }}" class="footer-columns__link">Онлайн-закупки на сайте</a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-columns__column">
                        <h4 class="footer-columns__title">Разное:</h4>
                        <ul class="footer-columns__list">
                            <li class="footer-columns__item">
                                <a href="{{ route('designers') }}" class="footer-columns__link">Дизайнерам</a>
                            </li>
                            <li class="footer-columns__item">
                                <a href="#" class="footer-columns__link footer-columns__link--discount">
                                    % Скидки
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="footer-columns__side footer-columns__side--right">
                    <div class="footer-columns__column">
                        <h4 class="footer-columns__title">Услуги:</h4>
                        <ul class="footer-columns__list">
                            <li class="footer-columns__item">
                                <a href="{{ route('repair') }}" class="footer-columns__link">Реставрация и ремонт мебели</a>
                            </li>
                            <li class="footer-columns__item">
                                <a href="{{ route('restaurant') }}" class="footer-columns__link ">
                                    Старинная и антикварная мебель на заказ для ресторанов
                                </a>
                            </li>
                            <li class="footer-columns__item">
                                <a href="{{ route('restaurant') }}" class="footer-columns__link ">
                                    Мебель для ресторанов и бутиков
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-columns__column">
                        <h4 class="footer-columns__title">Оплата и доставка:</h4>
                        <ul class="footer-columns__list">
                            <li class="footer-columns__item">
                                        <a href="{{ route('order') }}" class="footer-columns__link">
                                            Как сделать заказ?
                                        </a>
                            </li>
                                    <li class="footer-columns__item">
                                        <a href="{{ route('delivery') }}" class="footer-columns__link">Доставка</a>
                                    </li>
                                    <li class="footer-columns__item">
                                        <a href="{{ route('contacts') }}" class="footer-columns__link">Контакты</a>
                                    </li>
                        </ul>
                    </div>
                </div>
                <div class="footer-columns__column">
                    <h4 class="footer-columns__title">Каталог:</h4>
                    <ul class="footer-columns__list">
                        <li class="footer-columns__item"><a href="{{ route('catalog.category', 'vintazhnye-shkafy-bufety-vitriny') }}" class="footer-columns__link">Шкафы</a>
                        </li>
                        <li class="footer-columns__item"><a href="{{ route('catalog.category', 'bufeti') }}" class="footer-columns__link">Буфеты</a>
                        </li>
                        <li class="footer-columns__item"><a href="{{ route('catalog.category', 'vitrini') }}" class="footer-columns__link">Витрины</a>
                        </li>
                        <li class="footer-columns__item"><a href="{{ route('catalog.category', 'myagkaya-mebel-i-stulya') }}" class="footer-columns__link">Мягкая
                                мебель</a>
                        </li>
                        <li class="footer-columns__item"><a href="{{ route('catalog.category', 'spalni') }}" class="footer-columns__link">Спальни</a>
                        </li>
                        <li class="footer-columns__item"><a href="{{ route('catalog.category', 'kabinet') }}" class="footer-columns__link">Кабинеты</a>
                        </li>
                        <li class="footer-columns__item"><a href="{{ route('catalog.category', 'zerkala-konsoli') }}" class="footer-columns__link">Зеркала</a>
                        </li>
                        <li class="footer-columns__item"><a href="{{ route('catalog.category', 'chasy') }}" class="footer-columns__link">Часы</a>
                        </li>
                        <li class="footer-columns__item"><a href="{{ route('catalog') }}" class="footer-columns__link">В каталог
                                <img src="{{ asset('images/icons/arrow_right.svg') }}" alt=""></a>
                        </li>
                    </ul>
                </div>

                <div class="footer-columns__column footer-columns__column--contacts">
                    <div class="footer-comtacts">
                        <h4 class="footer-columns__name">Чаты и соц. сети:</h4>
                                <x-social-links class="footer-socials" />
                    </div>
                    <div class="footer-contacts">
                        <h4 class="footer-columns__name">Звоните:</h4>
                        <ul class="footer-contacts__phones">
                            <li>
                                <x-duty-phone class="footer-contacts__phone" />
                            </li>
                        </ul>
                    </div>
                    <div class="footer-contacts">
                        <h4 class="footer-columns__name">Пишите:</h4>
                        <a href="mailto:info@woodstream.online"
                            class="footer-contacts__email">info@woodstream.online</a>
                        <span class="footer-contacts__worktime"><img src="{{ asset('images/icons/mail.svg') }}" alt=""> По
                            будням</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom__inner">
                <a href="#" class="footer-policy">Политика конфиденциальности</a>
                <span class="footer-copyright">© Woodstream – винтажная мебель, 2025</span>
            </div>
        </div>
    </div>
</footer>

