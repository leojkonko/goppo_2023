@extends('front.layout.app')

@section('content')
    <main id="">

        <x-banners />

        @if (count($products->getApplications()))
            <section class="py-2 py-lg-4">
                <div class="container">
                    <h2 class="title mb-2 h2-40 p-400 text-dark w-100 text-center">
                        <svg class="me-2" width="200" height="3" viewBox="0 0 200 3" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="200" y="0.5" width="2.00001" height="200"
                                transform="rotate(90 200 0.5)" fill="#f0611f" />
                        </svg>
                        Nossas Linhas
                        <svg class="ms-2" width="200" height="3" viewBox="0 0 200 3" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="200" y="0.5" width="2.00001" height="200"
                                transform="rotate(90 200 0.5)" fill="#f0611f" />
                        </svg>
                    </h2>
                    <div class="categories-swiper position-relative">
                        <div class="swiper-wrapper">
                            @foreach ($products->getApplications() as $index => $line)
                                <a href="{{ route_lang('products', ['application' => $line->slug]) }}"
                                    class="category-card swiper-slide ratio ratio-1x1 d-block position-relative">
                                    <img class="object-fit-cover w-100 h-100" src="{{ $line->image()->first()?->url() }}"
                                        alt="">
                                    <div
                                        class="d-flex flex-column align-items-center justify-content-center p-1 p-sm-2 text-center gap-0-50 gap-sm-1 bg-linhas">
                                        {{-- <span class="text-uppercase fw-light position-absolute mt-2 top-0 start-50 translate-middle-x text-white p-22 p-400">{{ $index + 1 }}</span> --}}
                                        <h3 class="h2-32 p-700 text-white banner-title editor-texto">{{ $line->title }}
                                        </h3>
                                        <p class="p-16 p-400 text-white d-none banner-title editor-texto">
                                            {{ $line->text_1 }}
                                        </p>
                                    </div>
                                    <svg class="position-absolute top-99 start-50 translate-middle ratio-unstyled"
                                        width="160" height="10" viewBox="0 0 160 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="160" height="10" fill="#f0611f" />
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                        <div class="swiper-pagination d-lg-none mt-4" style="bottom: -30px;"></div>
                    </div>
                </div>
            </section>
        @endif
        <section class="brief py-lg-4 py-3">
            <div class=" bg-azul-escuro">
                <div class="container container-start">
                    <div class="row g-0">
                        @if ($page_home->text)
                            <div
                                class="col-lg-6 d-flex justify-content-center align-items-center position-relative text-lg-start text-center py-2 py-lg-0">
                                <svg class="position-absolute end-0 top-0" width="588" height="100%"
                                    viewBox="0 0 588 470" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <ellipse opacity="0.1" cx="448" cy="235" rx="448" ry="258"
                                        fill="black" />
                                </svg>
                                <div class="pe-lg-4">
                                    <div class="editor-texto brief-title pb-2">
                                        {!! $page_home->text !!}
                                    </div>
                                    <div class="editor-texto brief-text">
                                        {!! $page_home->text_1 !!}
                                    </div>
                                    @if ($page_home->text_3 && $page_home->text_2)
                                        <a href="{{ $page_home->text_3 }}"
                                            class="btn mt-1 btn-outline-light rounded-0 p-16 p-400 text-white">
                                            {{ $page_home->text_2 }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                        @if ($page_home->images()->count())
                            <div class="col-lg-6">
                                <div class="brief-swiper swiper">
                                    <div class="swiper-wrapper">
                                        @foreach ($page_home->images as $image)
                                            <div class="swiper-slide ratio ratio-16x9">
                                                <img class="object-fit-contain w-100 h-100 p-3" src="{{ $image->url() }}"
                                                    alt="">
                                            </div>
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
                    </div>
                </div>
            </div>
        </section>
        <section class="brief py-lg-4 py-3 position-relative">
            @if (count($products->getFeaturedProducts()))
                <div class="container ">
                    <div class="row g-0">
                        <h2 class="title mb-2 h2-40 p-400 text-dark w-100 text-center">
                            <svg class="me-2" width="200" height="3" viewBox="0 0 200 3" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="200" y="0.5" width="2.00001" height="200"
                                    transform="rotate(90 200 0.5)" fill="#f0611f" />
                            </svg>
                            Produtos Destaques
                            <svg class="ms-2" width="200" height="3" viewBox="0 0 200 3" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="200" y="0.5" width="2.00001" height="200"
                                    transform="rotate(90 200 0.5)" fill="#f0611f" />
                            </svg>
                        </h2>
                        <div class="produtos-swiper swiper mb-4 mb-lg-2">
                            <div class="swiper-wrapper">
                                @foreach ($products->getFeaturedProducts() as $index => $item)
                                    <a href="{{ route_lang('detalhe', ['id' => $item->id]) }}"
                                        class="swiper-slide product-border ratio ratio-1x1 bg-white p-2 position-relative overflow-hidden a-produtos">
                                        @if ($item->image()->first())
                                            <img class="object-fit-cover w-100 h-100 produtos-hover"
                                                src="{{ $item->image()->first()->url() }}" alt="">
                                        @endif
                                        <div class="d-flex bottom-0 start-0 pb-2 ratio-unstyled-all">
                                            @if ($item->applications->first())
                                                <p class="flex-column p-16 p-400 m-0 text-dark">
                                                    <span class="p-700">{{ $item->name }}</span><br>
                                                    {{ $item->applications->first()->name }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="d-flex bottom-0 end-0 p-2 ratio-unstyled-all">
                                            @foreach ($item->tags->take(2) as $tag)
                                                <div class="btn-padding ms-1 tag-badge d-flex align-items-center badge">
                                                    {{ $tag->name }} </div>
                                            @endforeach
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div
                                class="swiper-button-prev w-51 h-51 top-50 border border-white rounded-circle bg-rgb d-none d-lg-flex">
                                <svg width="21" height="22" viewBox="0 0 21 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 0.999998L0.999998 11M0.999998 11L11 21M0.999998 11L21 11"
                                        stroke="white" />
                                </svg>
                            </div>
                            <div
                                class="swiper-button-next w-51 h-51 top-50 border border-white rounded-circle bg-rgb d-none d-lg-flex">
                                <svg width="21" height="22" viewBox="0 0 21 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 21L20 11M20 11L10 0.999999M20 11L7.41552e-07 11" stroke="white" />
                                </svg>
                            </div>
                            <div class="swiper-pagination swiper-pagination-position d-lg-none mt-3"></div>
                        </div>
                        <div class="w-100 text-center">
                            <a href="{{ route('products') }}"
                                class="mt-2 mt-lg-1 btn btn-primary p-400 p-16 text-white rounded-0">Veja mais produtos</a>
                        </div>
                    </div>
                </div>
            @endif
        </section>
    </main>
@endsection
