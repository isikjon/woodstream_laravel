@props(['title' => 'СЕО текст'])

<section class="ceo">
    <div class="container">
        <h2 class="section-title">{{ $title }}</h2>
        <p class="ceo-text">
            {!! $slot !!}
        </p>
    </div>
</section>

