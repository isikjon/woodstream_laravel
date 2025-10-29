@props(['items' => []])

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
            @foreach($items as $item)
            <li class="breadcrumbs-item">
                @if(isset($item['url']))
                <a href="{{ $item['url'] }}" class="breadcrumbs-link">{{ $item['title'] }}</a>
                @else
                <span class="breadcrumbs-link breadcrumbs-link--active">{{ $item['title'] }}</span>
                @endif
                @if(!$loop->last)
                <span>/</span>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
</div>

