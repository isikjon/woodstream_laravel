@extends('layouts.base')

@section('title', 'Отзывы - WoodStream')

@section('content')
<x-breadcrumbs.index :items="[
    ['title' => 'Главная', 'url' => route('home')],
    ['title' => 'Отзывы', 'url' => null]
]" />

<section class="reviews">
    <div class="container">
        <h2 class="section-title">Отзывы</h2>
        <div class="reviews-grid">
            @foreach($reviews as $review)
                <a href="#" class="reviews-item {{ !$review->is_moderated ? 'reviews-item--moderation' : '' }}">
                    <img src="{{ $review->image_url }}" alt="" class="reviews-item__img">
                    <p class="reviews-item__text">
                        {{ $review->text }}
                    </p>
                    <span class="reviews-item__date">
                        {{ $review->created_at->format('Y-m-d H:i:s') }}
                    </span>
                    @if(!$review->is_moderated)
                        <div class="reviews-item__status" style="background: #fff3cd; color: #856404; padding: 5px 10px; border-radius: 3px; font-size: 12px; margin-top: 5px;">
                            На модерации
                        </div>
                    @endif
                </a>
            @endforeach
        </div>
        <div class="reviews-form">
            <p>
                Дорогие друзья! Интересно узнать, как "поживает" приобретенная у нас мебель в Ваших
                интерьерах. Спасибо всем, кто присылает фотографии! Нам очень приятно видеть, как старинная
                мебель получает свою вторую жизнь. Если кто-то не увидел свои фотографии здесь, присылайте
                на почту info@woodstream.online мы с радостью их разместим.
            </p>
            
            @if(session('success'))
                <div class="alert alert-success" style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-top: 20px; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="name" placeholder="Имя" class="reviews-input" value="{{ old('name') }}" required>
                <textarea name="text" placeholder="Отзыв" class="reviews-textarea" maxlength="130" required>{{ old('text') }}</textarea>
                <div style="font-size: 12px; color: #666; margin-bottom: 10px;">
                    Осталось символов: <span id="char-count">130</span>
                </div>
                <input type="file" name="image" class="reviews-input" accept="image/*" required>
                <button type="submit" class="product-button">
                    Добавить отзыв
                    <span class="product-button__arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="6" height="11" viewBox="0 0 6 11"
                            fill="none">
                            <path
                                d="M0.472589 0.9177C0.410103 0.979675 0.360507 1.05341 0.326661 1.13465C0.292816 1.21589 0.27539 1.30302 0.27539 1.39103C0.27539 1.47904 0.292816 1.56618 0.326661 1.64742C0.360507 1.72866 0.410104 1.80239 0.472589 1.86436L3.52592 4.9177C3.58841 4.97967 3.638 5.05341 3.67185 5.13465C3.7057 5.21589 3.72312 5.30302 3.72312 5.39103C3.72312 5.47904 3.7057 5.56618 3.67185 5.64742C3.638 5.72866 3.58841 5.80239 3.52592 5.86437L0.472589 8.9177C0.410104 8.97967 0.360507 9.05341 0.326662 9.13465C0.292816 9.21589 0.275391 9.30302 0.275391 9.39103C0.275391 9.47904 0.292816 9.56618 0.326662 9.64742C0.360508 9.72866 0.410104 9.80239 0.472589 9.86437C0.597498 9.98853 0.766466 10.0582 0.942589 10.0582C1.11871 10.0582 1.28768 9.98853 1.41259 9.86437L4.47259 6.80437C4.84712 6.42936 5.0575 5.92103 5.0575 5.39103C5.0575 4.86103 4.84712 4.3527 4.47259 3.9777L1.41259 0.9177C1.28768 0.793532 1.11871 0.723837 0.942589 0.723837C0.766465 0.723837 0.597497 0.793532 0.472589 0.9177Z"
                                fill="#F0F4FF"></path>
                        </svg>
                    </span>
                </button>
            </form>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.querySelector('textarea[name="text"]');
    const charCount = document.getElementById('char-count');
    
    if (textarea && charCount) {
        function updateCharCount() {
            const remaining = 130 - textarea.value.length;
            charCount.textContent = remaining;
            
            if (remaining < 0) {
                charCount.style.color = 'red';
            } else {
                charCount.style.color = '#666';
            }
        }
        
        textarea.addEventListener('input', updateCharCount);
        updateCharCount();
    }
});
</script>
@endsection
