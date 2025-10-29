@extends('layouts.base')

@section('title', $blog->title . ' - WoodStream')

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <ul class="breadcrumbs-list">
            <li class="breadcrumbs-item">
                <a href="{{ route('home') }}" class="breadcrumbs-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                        fill="none">
                        <path
                            d="M11.3333 11.9973V15.9998H14C15.1046 15.9998 16 15.1038 16 13.9986V7.91413C16.0002 7.56757 15.8655 7.23455 15.6247 6.98555L9.95934 0.857045C8.95972 -0.225192 7.27259 -0.29164 6.19103 0.708608C6.13965 0.756113 6.09016 0.805631 6.04269 0.857045L0.387344 6.98355C0.139158 7.23359 -8.9569e-05 7.57172 4.32253e-08 7.92413V13.9986C4.32253e-08 15.1038 0.895437 15.9998 2 15.9998H4.66666V11.9973C4.67912 10.1783 6.14684 8.69289 7.91894 8.65012C9.75031 8.6059 11.3194 10.1166 11.3333 11.9973Z"
                            fill="#1D2229" />
                        <path
                            d="M8 9.99628C6.89544 9.99628 6 10.8923 6 11.9975V16H10V11.9975C10 10.8923 9.10456 9.99628 8 9.99628Z"
                            fill="#1D2229" />
                    </svg>
                    Главная
                </a>
                <span>/</span>
            </li>
            <li class="breadcrumbs-list">
                <a href="{{ route('blog') }}" class="breadcrumbs-link">Блог</a>
                <span>/</span>
            </li>
            <li class="breadcrumbs-list">
                <span class="breadcrumbs-link breadcrumbs-link--active">{{ $blog->title }}</span>
            </li>
        </ul>
    </div>
</div>

<section class="blog blog--page">
    <div class="container">
        <article class="blog-article">
            <header class="blog-article__header">
                <h1 class="section-title">{{ $blog->title }}</h1>
                <div class="blog-article__meta">
                    <span class="blog-article__date">
                        @if($blog->created_at)
                            {{ $blog->created_at->format('d.m.Y') }}
                        @else
                            {{ now()->format('d.m.Y') }}
                        @endif
                    </span>
                    @if($blog->tags)
                        <span class="blog-article__tags">{{ $blog->tags }}</span>
                    @endif
                </div>
            </header>

            @if($blog->image_url)
                <div class="blog-article__image">
                    <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}">
                </div>
            @endif

            <div class="blog-article__content">
                {!! nl2br(e($blog->text)) !!}
            </div>
        </article>

        @if($relatedBlogs->count() > 0)
            <section class="related-blog">
                <h2 class="section-title">Похожие статьи</h2>
                <div class="blog-grid">
                    @foreach($relatedBlogs as $relatedBlog)
                        <div class="blog-item">
                            <a href="{{ route('blog.show', $relatedBlog->slug) }}" class="blog-item__image">
                                <img src="{{ $relatedBlog->image_url }}" alt="{{ $relatedBlog->title }}">
                            </a>
                            <div class="blog-item__content">
                                <span class="blog-item__tags">
                                    {{ $relatedBlog->tags }}
                                </span>
                                <a href="{{ route('blog.show', $relatedBlog->slug) }}">
                                    <h3 class="blog-item__name">{{ $relatedBlog->title }}</h3>
                                </a>
                                <p class="blog-item__text">
                                    {{ $relatedBlog->excerpt }}
                                </p>
                                <div class="blog-item__date">
                                    @if($relatedBlog->created_at)
                                        {{ $relatedBlog->created_at->format('d.m.Y') }}
                                    @else
                                        {{ now()->format('d.m.Y') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</section>

<section class="ceo">
    <div class="container">
        <h2 class="section-title">СЕО текст</h2>
        <p class="ceo-text">
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
        </p>
    </div>
</section>
@endsection

@push('styles')
<style>
.blog-article__header {
    margin-bottom: 30px;
}

.blog-article__meta {
    display: flex;
    gap: 20px;
    margin-top: 15px;
    color: #666;
    font-size: 14px;
}

.blog-article__image {
    margin-bottom: 30px;
}

.blog-article__image img {
    width: 100%;
    height: auto;
    border-radius: 8px;
}

.blog-article__content {
    line-height: 1.8;
    color: #333;
    margin-bottom: 50px;
}

.related-blog {
    margin-top: 50px;
    padding-top: 30px;
    border-top: 1px solid #eee;
}
</style>
@endpush
