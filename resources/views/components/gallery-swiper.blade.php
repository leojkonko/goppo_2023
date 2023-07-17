@php
    $thumbnail = $thumbnail[0] ?? false;
    $video = $video ?? false;
@endphp

<div class="gallery-swiper overflow-hidden rounded-3">
    <div class="swiper-wrapper">

        @if ($video)
            <a href="{{ $video }}" data-fancybox="gallery" class="d-block video-slide swiper-slide">
                @if ($thumbnail)
                    <img class="w-100 h-100 object-fit-cover" data-src="{{ $thumbnail->url() }}"alt="{{ $thumbnail->alt }}" title="{{ $thumbnail->description }}">
                    <div class="loader position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                        <div class="spinner-border fs-4 text-secondary"></div>
                        <span class="fw-normal text-secondary">
                            Carregando imagem...
                        </span>
                    </div>
                @endif
                <div class="position-absolute top-0 start-0 d-flex align-items-center justify-content-center h-100 w-100">
                    <svg class="play" width="1em" height="1em" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="60" cy="60" r="59" stroke="white" stroke-width="2"></circle>
                        <path d="M87 60L46.5 83.3827L46.5 36.6173L87 60Z" fill="transparent" stroke="white" stroke-width="2"></path>
                    </svg>
                </div>
            </a>
        @endif

        @foreach ($images as $image)
            <a href="{{ $image->url() }}" data-fancybox="gallery" class="d-block swiper-slide">
                <img class="w-100 h-100 object-fit-cover" data-src="{{ $image->url() }}" alt="{{ $image->alt }}" title="{{ $image->description }}">
                <div class="loader position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                    <div class="spinner-border fs-4 text-secondary"></div>
                    <span class="fw-normal text-secondary">
                        Carregando imagem...
                    </span>
                </div>
            </a>
        @endforeach

    </div>
    <div class="swiper-pagination h-auto"></div>
</div>
