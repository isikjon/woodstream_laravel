@extends('layouts.base')

@section('title', 'Контакты - WoodStream')

@section('content')
<x-breadcrumbs.index :items="[
    ['title' => 'Главная', 'url' => route('home')],
    ['title' => 'Контакты', 'url' => null]
]" />

<section class="content">
    <div class="container">
        <h2 class="section-title">Контакты</h2>

        <div class="content-map">
            <iframe
                src="https://yandex.ru/map-widget/v1/?lang=ru_RU&amp;scroll=false&amp;source=constructor-api&amp;um=constructor%3Aa5a09c7926053356fe50ed5815538d9e653da620a66e140e9eeaea18b5897c2d"
                frameborder="0" allowfullscreen="true" width="100%" height="550px" style="display: block;">
            </iframe>
        </div>
        <h2 class="content-title">Адрес</h2>
        <p><strong>ЮРИДИЧЕСКИЙ АДРЕС</strong></p>
        <p>
            445143, Россия, Самарская обл., Ставропольский м.р-н, Подстепки с.п., Подстепки с., Лазурный
            пер., д. 5, кв. 15
        </p>

        <h3 class="content-name">Наши менеджеры всегда на связи и ответят на все вопросы</h3>
        <x-contacts-list />
        <h2 class="content-title">Соцсети:</h2>
        <div class="content-grid content-grid--social">
            <a href="https://t.me/woodstream_antique" target="_blank">
                <img src="{{ asset('images/icons/telegram.svg') }}" alt="">
                <span>Telegram</span>
            </a>
            <a href="https://wa.me/79397550591" target="_blank">
                <img src="{{ asset('images/icons/whatsapp.svg') }}" alt="">
                <span>WhatsApp</span>
            </a>
            <a href="https://instagram.com/woodstream_antique" target="_blank">
                <img src="{{ asset('images/icons/instagram.svg') }}" alt="">
                <span>Instagram</span>
            </a>
            <a href="https://vk.com/club87567029" target="_blank">
                <img src="{{ asset('images/icons/vk.svg') }}" alt="">
                <span>VK</span>
            </a>
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
