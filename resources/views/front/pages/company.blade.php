@extends('front.layout.app')

@section('content')
    <main id="empresa" class="row gx-0 overflow-hidden">
        <section class="brief">
            <div class="bg-azul-escuro">
                <div class="row g-0">
                    @if ($page->text)
                        <div
                            class="col-lg-{{ $page->images()->count() ? '6' : '12' }} d-flex justify-content-center align-items-center position-relative text-lg-start text-center py-2 py-lg-4">
                            @if ($page->images()->count())
                                <svg class="position-absolute end-0 top-0" width="588" height="100%" viewBox="0 0 588 470"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <ellipse opacity="0.1" cx="448" cy="235" rx="448" ry="258"
                                        fill="black" />
                                </svg>
                            @endif
                            <div class="pe-lg-4" style="width: 80%">
                                <div class="editor-texto brief-text">
                                    {!! $page->text !!}
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($page->images()->count())
                        <div class="col-lg-{{ $page->images()->count() ? '6' : '12' }}">
                            <div class="brief-swiper swiper">
                                <div class="swiper-wrapper">
                                    @foreach ($page->images as $image)
                                        <a class="swiper-slide ratio ratio-16x9" href="{{ $image->url() }}"
                                            data-fancybox="gallery">
                                            <img class="object-fit-cover w-100 h-100" src="{{ $image->url() }}"
                                                alt="">
                                        </a>
                                    @endforeach
                                </div>
                                <div class="swiper-button-prev w-51 h-51 border border-white rounded-circle bg-rgb">
                                    <svg width="21" height="22" viewBox="0 0 21 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 0.999998L0.999998 11M0.999998 11L11 21M0.999998 11L21 11"
                                            stroke="white" />
                                    </svg>
                                </div>
                                <div class="swiper-button-next w-51 h-51 border border-white rounded-circle bg-rgb">
                                    <svg width="21" height="22" viewBox="0 0 21 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 21L20 11M20 11L10 0.999999M20 11L7.41552e-07 11" stroke="white" />
                                    </svg>
                                </div>
                                {{-- <div class="swiper-pagination"></div> --}}
                            </div>
                        </div>
                    @endif
                    @if ($page->images_v2()->count())
                        <div class="col-lg-{{ $page->images()->count() ? '6' : '12' }}">
                            <div class="brief-swiper swiper">
                                <div class="swiper-wrapper">
                                    @foreach ($page->images_v2 as $image)
                                        <a class="swiper-slide ratio ratio-16x9" href="{{ $image->url() }}"
                                            data-fancybox="gallery">
                                            <img class="object-fit-cover w-100 h-100" src="{{ $image->url() }}"
                                                alt="">
                                        </a>
                                    @endforeach
                                </div>
                                <div class="swiper-button-prev w-51 h-51 border border-white rounded-circle bg-rgb">
                                    <svg width="21" height="22" viewBox="0 0 21 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 0.999998L0.999998 11M0.999998 11L11 21M0.999998 11L21 11"
                                            stroke="white" />
                                    </svg>
                                </div>
                                <div class="swiper-button-next w-51 h-51 border border-white rounded-circle bg-rgb">
                                    <svg width="21" height="22" viewBox="0 0 21 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 21L20 11M20 11L10 0.999999M20 11L7.41552e-07 11" stroke="white" />
                                    </svg>
                                </div>
                                {{-- <div class="swiper-pagination"></div> --}}
                            </div>
                        </div>
                    @endif
                    @if ($page->text_1)
                        <div
                            class="col-lg-{{ $page->images_v2()->count() ? '6' : '12' }} d-flex bg-white justify-content-center align-items-center position-relative text-lg-start text-center py-2 py-lg-4">
                            <div class="pe-lg-4" style="width: 80%">
                                <div class="editor-texto brief-text-v2">
                                    {!! $page->text_1 !!}
                                </div>
                            </div>

                        </div>
                    @endif
                </div>
            </div>
        </section>
        {{-- Deactivates NumbersUp --}}
        @if (0)
            <section class="py-lg-4 py-2">
                <div class="container">
                    <div class="row justify-content-around numbers-up gy-4">
                        @if ($page->count_up[0]['num_target'])
                            @foreach ($page->count_up as $row)
                                <div class="col-6 col-lg-3">
                                    <div class="row justify-content-center text-center text-primary">
                                        <h2 class="fs-1 fw-bold" style="opacity: 0.4">
                                            <span class="counter-up" data-plus="1"
                                                data-val="{{ $row['num_target'] }}">0</span>
                                            {{ $row['num_unity'] }}
                                        </h2>
                                    </div>
                                    <div class="row justify-content-center text-center text-muted">
                                        <h6 class="text">{{ $row['num_subject'] }}</h6>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </section>
        @endif


        @if ($ourHistories->count())
            <section class="historia pt-2 pt-lg-4 bg-light">
                <div class="container">
                    <h2 class="title mb-2">
                        {{ __('Nossa história') }}
                    </h2>
                </div>
                <div class="py-2 py-lg-4">
                    <div class="container">
                        <div class="historia-swiper">
                            <div class="swiper-wrapper">
                                @foreach ($ourHistories as $ourHistory)
                                    <div class="card h-auto swiper-slide d-flex align-items-center gap-2">
                                        <div class="d-flex flex-column h-100 w-100">
                                            <div class="ratio ratio-16x9">
                                                @if ($ourHistory->image->count())
                                                    <img class="object-fit-cover"
                                                        src="{{ $ourHistory->image->first()->url() }}"
                                                        alt="{{ $ourHistory->image->first()->title }}">
                                                @endif
                                                <div class="d-flex align-items-end justify-content-start">
                                                    <span
                                                        class="badge h5 p-0-50 bg-primary mb-0">{{ $ourHistory->title_1 }}</span>
                                                </div>
                                            </div>
                                            <div class="bg-white h-100 p-1 p-sm-2 editor-texto">
                                                {!! $ourHistory->text_1 !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        {{-- @if ($page->text_4 || $page->image_solo->count())
            <section>
                <div>
                    <div class="row g-0 justify-content-center">
                        @if ($page->image_solo->first())
                            <div class="col-lg-6">
                                <a class="ratio ratio-9x6 h-100" href="{{ $page->image_solo->first()->url() }}"
                                    data-fancybox="gallery">
                                    <img class="w-100 h-100 object-fit-cover"
                                        src="{{ $page->image_solo->first()->url() }}" alt="Logo {{ env('APP_NAME') }}">
                                </a>
                            </div>
                        @endif
                        @if (strlen($page->text_4) > 12)
                            <div class="col-lg-6 bg-white p-lg-4 p-2 d-flex align-items-center">
                                <div>
                                    <div class="editor-texto py-4">
                                        {!! $page->text_4 !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endif --}}

        @if ($page->gallery->count())
            <section class=" mt-0-50">
                <div class="px-1 px-lg-0">
                    <div class="row">
                        <div class="empresa-swiper swiper">
                            <div class="swiper-wrapper mb-0-50">
                                @foreach ($page->gallery as $image)
                                    <div class="swiper-slide">
                                        <a href="{{ $image->url() }}" data-fancybox="gallery">
                                            <div class="ratio ratio-16x9">
                                                <img class="w-100 h-100 object-fit-cover" src="{{ $image->url() }}"
                                                    alt="Banner Image">
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <div
                                class="swiper-button-prev top-40 start-5 w-51 h-51 border border-white rounded-circle bg-rgb d-none d-lg-flex">
                                <svg width="21" height="22" viewBox="0 0 21 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 0.999998L0.999998 11M0.999998 11L11 21M0.999998 11L21 11"
                                        stroke="white" />
                                </svg>
                            </div>
                            <div
                                class="swiper-button-next end-5 top-40 w-51 h-51 border border-white rounded-circle bg-rgb d-none d-lg-flex">
                                <svg width="21" height="22" viewBox="0 0 21 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 21L20 11M20 11L10 0.999999M20 11L7.41552e-07 11" stroke="white" />
                                </svg>
                            </div>
                            <div class="swiper-pagination mb-1 d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </main>
@endsection
