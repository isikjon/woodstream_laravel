@extends('layouts.base')

@section('title', 'Старинная и антикварная мебель на заказ для ресторанов - WoodStream')

@section('content')
<x-breadcrumbs.index :items="[
    ['title' => 'Старинная и антикварная мебель на заказ для ресторанов']
]" />

<section class="content">
    <div class="container">
        <h2 class="section-title">Старинная и антикварная мебель на заказ для ресторанов</h2>
        <p>
            В наши дни особой популярностью пользуется мебель на заказ для ресторанов, винтажная мебель,
            доставляемая со всей Европы. Ведь, почти все ее страны славятся своей историей и приверженностью
            традициям. Для ценителей старины, такие страны, как Великобритания, Голландия, Франция и Бельгия
            – настоящая сокровищница разнообразных антикварных вещиц и винтажных предметов обстановки,
            трепетно сбереженных на протяжении многих веков.
        </p>
        <p>
            При этом трудно найти в той же Британии что-либо более традиционно английское, чем пабы, которые
            являются визитной карточкой многие годы. Очарование небольших пабов с их потемневшим от времени
            деревом и особой атмосферой оказалось так велико, что теперь из Англии барная мебель на заказ
            распространилась по всему миру, в том числе полюбилась Россиянам – ведь каждый предмет передает
            частичку британского уюта и основательности. Или как же может обойтись без чудесных легких
            винтажных кресел и стульев так полюбившийся многим французский стиль Прованс, часто используемый
            в оформлении ресторанов? Привезенная нами мебель способна украсить любой интерьер – и это именно
            та самая «изюминка», ключевой и финальный штрих для ресторана с хорошим вкусом.
        </p>
        <h3 class="content-name">ВИТРИНЫ И БУФЕТЫ</h3>
        <div class="content-images">
            <a href="{{ asset('images/content/buffets-1.jpg') }}" data-fancybox="gallery">
                <img src="{{ asset('images/content/buffets-1.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/buffets-2.jpg') }}" data-fancybox="gallery">
                <img src="{{ asset('images/content/buffets-2.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/buffets-3.jpg') }}" data-fancybox="gallery">
                <img src="{{ asset('images/content/buffets-3.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/buffets-4.jpg') }}" data-fancybox="gallery">
                <img src="{{ asset('images/content/buffets-4.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/buffets-5.jpg') }}" data-fancybox="gallery">
                <img src="{{ asset('images/content/buffets-5.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/buffets-6.jpg') }}" data-fancybox="gallery">
                <img src="{{ asset('images/content/buffets-6.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/buffets-7.jpg') }}" data-fancybox="gallery">
                <img src="{{ asset('images/content/buffets-7.jpg') }}" alt="">
            </a>
        </div>
        <h3 class="content-name">МЯГКАЯ МЕБЕЛЬ</h3>
        <div class="content-images">
            <a href="{{ asset('images/content/soft-1.jpg') }}" data-fancybox="gallery-2">
                <img src="{{ asset('images/content/soft-1.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/soft-2.jpg') }}" data-fancybox="gallery-2">
                <img src="{{ asset('images/content/soft-2.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/soft-3.jpg') }}" data-fancybox="gallery-2">
                <img src="{{ asset('images/content/soft-3.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/soft-4.jpg') }}" data-fancybox="gallery-2">
                <img src="{{ asset('images/content/soft-4.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/soft-5.jpg') }}" data-fancybox="gallery-2">
                <img src="{{ asset('images/content/soft-5.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/soft-6.jpg') }}" data-fancybox="gallery-2">
                <img src="{{ asset('images/content/soft-6.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/soft-7.jpg') }}" data-fancybox="gallery-2">
                <img src="{{ asset('images/content/soft-7.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/soft-8.jpg') }}" data-fancybox="gallery-2">
                <img src="{{ asset('images/content/soft-8.jpg') }}" alt="">
            </a>
        </div>
        <h3 class="content-name">СТОЛОВЫЕ ГРУППЫ</h3>
        <div class="content-images">
            <a href="{{ asset('images/content/dining-1.jpg') }}" data-fancybox="gallery-3">
                <img src="{{ asset('images/content/dining-1.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/dining-2.jpg') }}" data-fancybox="gallery-3">
                <img src="{{ asset('images/content/dining-2.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/dining-3.jpg') }}" data-fancybox="gallery-3">
                <img src="{{ asset('images/content/dining-3.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/dining-4.jpg') }}" data-fancybox="gallery-3">
                <img src="{{ asset('images/content/dining-4.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/dining-5.jpg') }}" data-fancybox="gallery-3">
                <img src="{{ asset('images/content/dining-5.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/soft-6.jpg') }}" data-fancybox="gallery-3">
                <img src="{{ asset('images/content/soft-6.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/soft-7.jpg') }}" data-fancybox="gallery-3">
                <img src="{{ asset('images/content/soft-7.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/soft-8.jpg') }}" data-fancybox="gallery-3">
                <img src="{{ asset('images/content/soft-8.jpg') }}" alt="">
            </a>
        </div>
        <h3 class="content-name">СТОЛЫ И СТУЛЬЯ</h3>
        <div class="content-images">
            <a href="{{ asset('images/content/tables-1.jpg') }}" data-fancybox="gallery-4">
                <img src="{{ asset('images/content/tables-1.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/tables-2.jpg') }}" data-fancybox="gallery-4">
                <img src="{{ asset('images/content/tables-2.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/tables-3.jpg') }}" data-fancybox="gallery-4">
                <img src="{{ asset('images/content/tables-3.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/tables-4.jpg') }}" data-fancybox="gallery-4">
                <img src="{{ asset('images/content/tables-4.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/tables-5.jpg') }}" data-fancybox="gallery-4">
                <img src="{{ asset('images/content/tables-5.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/tables-6.jpeg') }}" data-fancybox="gallery-4">
                <img src="{{ asset('images/content/tables-6.jpeg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/tables-7.jpg') }}" data-fancybox="gallery-4">
                <img src="{{ asset('images/content/tables-7.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/tables-8.jpg') }}" data-fancybox="gallery-4">
                <img src="{{ asset('images/content/tables-8.jpg') }}" alt="">
            </a>
        </div>
        <h3 class="content-name">ДРЕССЕРЫ, ТУМБЫ, КОМОДЫ</h3>
        <div class="content-images">
            <a href="{{ asset('images/content/dresser-1.jpg') }}" data-fancybox="gallery-5">
                <img src="{{ asset('images/content/dresser-1.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/dresser-2.jpg') }}" data-fancybox="gallery-5">
                <img src="{{ asset('images/content/dresser-2.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/dresser-3.jpg') }}" data-fancybox="gallery-5">
                <img src="{{ asset('images/content/dresser-3.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/dresser-4.jpg') }}" data-fancybox="gallery-5">
                <img src="{{ asset('images/content/dresser-4.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/dresser-5.jpg') }}" data-fancybox="gallery-5">
                <img src="{{ asset('images/content/dresser-5.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/dresser-6.jpg') }}" data-fancybox="gallery-5">
                <img src="{{ asset('images/content/dresser-6.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/dresser-7.jpg') }}" data-fancybox="gallery-5">
                <img src="{{ asset('images/content/dresser-7.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/dresser-8.jpg') }}" data-fancybox="gallery-5">
                <img src="{{ asset('images/content/dresser-8.jpg') }}" alt="">
            </a>
        </div>
        <h3 class="content-name">ДЛЯ ИНТЕРЬЕРА</h3>
        <div class="content-images">
            <a href="{{ asset('images/content/for-int-1.jpg') }}" data-fancybox="gallery-6">
                <img src="{{ asset('images/content/for-int-1.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/for-int-2.jpg') }}" data-fancybox="gallery-6">
                <img src="{{ asset('images/content/for-int-2.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/for-int-3.jpg') }}" data-fancybox="gallery-6">
                <img src="{{ asset('images/content/for-int-3.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/for-int-4.jpg') }}" data-fancybox="gallery-6">
                <img src="{{ asset('images/content/for-int-4.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/for-int-5.jpg') }}" data-fancybox="gallery-6">
                <img src="{{ asset('images/content/for-int-5.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/for-int-6.jpg') }}" data-fancybox="gallery-6">
                <img src="{{ asset('images/content/for-int-6.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/for-int-7.jpg') }}" data-fancybox="gallery-6">
                <img src="{{ asset('images/content/for-int-7.jpg') }}" alt="">
            </a>
            <a href="{{ asset('images/content/for-int-8.jpg') }}" data-fancybox="gallery-6">
                <img src="{{ asset('images/content/for-int-8.jpg') }}" alt="">
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

