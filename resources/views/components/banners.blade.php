@if (count($banners))
    <section class="banner ratio ratio-6x9 ratio-md-16x9 ratio-xl-21x9 overflow-hidden">
        <div class="banner-swiper">
            <div class="swiper-wrapper">
                @foreach ($banners as $banner)
                    <div class="swiper-slide banner-slide position-relative">
                        @if ($banner->text_1 || ($banner->text_2 && $banner->link_1))
                            <div class="position-absolute w-100 top-40 text-lg-end text-center z-index-3">
                                <div class="container">
                                    @if ($banner->text_1)
                                        <div class="banner-title editor-texto">
                                            {!! $banner->text_1 !!}
                                        </div>
                                    @endif
                                    @if ($banner->text_2 && $banner->link_1)
                                    <a href="{{ $banner->link_1 }}"
                                        class="btn btn-primary p-16 p-400 rounded-0 text-white mt-2">
                                        {{ $banner->text_2 }}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <picture>
                            <div class="bg-rgba position-absolute top-0 start-0 text-center w-100 h-100">
                            </div>
                            {{-- Desktop --}}
                            <source srcset="{{ $banner->bannerDesktop()->first()->url() }}" media="(min-width: 767px)">
                            {{-- Mobile --}}
                            @if ($banner->bannerMobile()->first())
                                <img class="object-fit-cover w-100 h-100"
                                    src="{{ $banner->bannerMobile()->first()->url() }}" alt="">
                            @else
                                <img class="object-fit-cover w-100 h-100"
                                    src="{{ $banner->bannerDesktop()->first()->url() }}" alt="">
                            @endif
                        </picture>

                        {{-- @if ($banner->link_1)
                            <a href="{{ $banner->link_1 }}" class="stretched-link"></a>
                        @endif --}}

                    </div>
                @endforeach
            </div>
            <div class="position-absolute bottom-0 end-0 bg-white d-none d-lg-block">
                <div class="w-100 bg-white position-relative z-index-1 controle-banner">
                    <div class=" w-50 h-100 position-absolute">
                        <div class="swiper-button-prev" style="margin-top: -1rem;">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 0.5L1 7.5M1 7.5L8 14.5M1 7.5L15 7.5" stroke="#505050"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="swiper-button-next" style="margin-top: -1rem;">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 14.5L14 7.5M14 7.5L7 0.5M14 7.5L-3.86392e-07 7.5" stroke="#505050"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="swiper-pagination pagination-unstyled"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
