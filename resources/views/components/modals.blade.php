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

<div class="modal modal-promo modal-promo-0" 
     data-modal-id="1" 
     data-delay="3" 
     data-order="0" 
     data-active="true"
     data-index="0">
    <div class="modal-content">
        <div class="modal-close modal-promo__close" data-modal-index="0">
            <img src="{{ asset('images/icons/moda-close.svg') }}" alt="Close">
        </div>
        
        <a href="https://t.me/woodstream63bot" target="_blank" class="modal-promo__body">
            <picture class="modal-promo__image">
                <source media="(max-width: 768px)" srcset="{{ asset('images/mobile1.png') }}">
                <img src="{{ asset('images/desktop1.svg') }}" alt="Woodstream в Telegram">
            </picture>
        </a>
    </div>
</div>

<div class="modal modal-promo modal-promo-1" 
     data-modal-id="2" 
     data-delay="5" 
     data-order="1" 
     data-active="true"
     data-index="1">
    <div class="modal-content">
        <div class="modal-close modal-promo__close" data-modal-index="1">
            <img src="{{ asset('images/icons/moda-close.svg') }}" alt="Close">
        </div>
        
        <a href="https://t.me/woodstream63bot" target="_blank" class="modal-promo__body">
            <picture class="modal-promo__image">
                <source media="(max-width: 768px)" srcset="{{ asset('images/mobile2.png') }}">
                <img src="{{ asset('images/desktop2.svg') }}" alt="Больше не нужно ждать">
            </picture>
        </a>
    </div>
</div>

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

