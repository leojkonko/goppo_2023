@extends('front.layout.app')

@section('content')
    <main id="produto" class="pb-lg-4 pb-2">
        <section class="produto-detalhe position-relative">
            <div class="container">
                <div class="row ">
                    <div class="m-auto d-flex" style="border: #a6a6a6 1px solid">
                        <div class="swiper produtos-detalhe-swiper col-12 col-lg-8 col-xl-6">
                            <div class="swiper-wrapper pb-4 pb-lg-0">
                                @foreach ($product->image as $image)
                                    <div class="swiper-slide">
                                        <div class="swiper-slide h-100">
                                            <div class="ratio ratio-16x9 h-100">
                                                <img class="object-fit-cover w-100 h-100" src="{{ $image->url() }}"
                                                    alt="">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div
                                class="swiper-button-next border border-primary w-51 h-51 end-5 top-40 rounded-circle d-none d-lg-flex">
                                <svg width="21" height="22" viewBox="0 0 21 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 21L20 11M20 11L10 0.999999M20 11L7.41552e-07 11" stroke="#277CEA" />
                                </svg>
                            </div>
                            <div
                                class="swiper-button-prev border border-primary w-51 h-51 start-5 top-40 rounded-circle d-none d-lg-flex">
                                <svg width="21" height="22" viewBox="0 0 21 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 1L0.999998 11M0.999998 11L11 21M0.999998 11L21 11" stroke="#277CEA" />
                                </svg>
                            </div>
                            <div class="swiper-pagination d-lg-none"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="py-2 pe-lg-4">
                            <div class="d-flex justify-content-start align-items-center titulo">
                                <h2 class="h2-40 p-400">{{ $product->name }}</h2>
                                @foreach ($product->tags->take(2) as $tag)
                                    <div class="btn-padding ms-1 tag-badge d-flex align-items-center badge fw-medium">
                                        {{ $tag->name }} </div>
                                @endforeach
                            </div>
                            <div class="p p-text pt-1">
                                <p>
                                    {!! $product->text !!}
                                </p>
                            </div>
                            <div class="pt-1">
                                <button class="btn btn-primary rounded-0 text-white p-14 interest-btn"
                                    data-bs-toggle="modal" data-bs-target="#formModal">TENHO
                                    INTERESSE</button>
                                @if ($product->catalog->first())
                                    <a href="{{ $product->catalog->first()->url() }}" target="_blank"
                                        class="btn btn-outline-primary rounded-0 text-dark p-14">VER NO CATÁLOGO</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        @if (strlen($product->text_1) > 37)
                            <div class="border border-dark p-2 mt-lg-2">
                                <div class="editor-texto specifications p-14">
                                    {!! $product->text_1 !!}
                                </div>
                            </div>
                        @endif
                        @if (strlen($product->text_2) > 12)
                            <div class="border{{ strlen($product->text_1) > 37 ? '-custom' : ' mt-2' }} border-dark p-2">
                                <div class="editor-texto specifications p-14">
                                    {!! $product->text_2 !!}
                                </div>
                            </div>
                        @endif

                        {{-- <livewire:form-interest-product :product_id="$product->id" /> --}}
                    </div>
                </div>
            </div>
        </section>
        @if (count($relatedProducts))
            <section class="relacionados mt-2 position-relative">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-start titulo">
                            <h2 class="title mt-2 h2-40 p-400 text-dark w-100 text-center">
                                <svg class="me-2" width="200" height="3" viewBox="0 0 200 3" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="200" y="0.5" width="2.00001" height="200"
                                        transform="rotate(90 200 0.5)" fill="#f0611f" />
                                </svg>
                                Produtos Relacionados
                                <svg class="ms-2" width="200" height="3" viewBox="0 0 200 3" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="200" y="0.5" width="2.00001" height="200"
                                        transform="rotate(90 200 0.5)" fill="#f0611f" />
                                </svg>
                            </h2>
                        </div>
                        <div class="swiper relacionados-swiper mt-2 col-11">
                            <div class="swiper-wrapper pb-2 pb-lg-0">
                                @foreach ($relatedProducts as $index => $relprod)
                                    <a href="{{ route_lang('detalhe', ['slug' => $relprod->slug]) }}"
                                        class="swiper-slide ratio ratio-1x1 bg-white p-2 position-relative overflow-hidden a-produtos">
                                        @if ($relprod->image()->first())
                                            <img class="object-fit-cover product-border w-100 h-100 produtos-hover"
                                                src="{{ $relprod->image()->first()->url() }}" alt="">
                                        @endif
                                        <div class="d-flex bottom-0 start-0 pb-2 ratio-unstyled-all">
                                            @if ($relprod->applications->first())
                                                <p class="flex-column p-16 p-400 m-0 text-dark">
                                                    <span class="p-700">{{ $relprod->name }}</span><br>
                                                    {{ $relprod->applications->first()->name }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="d-flex bottom-0 end-0 pt-2 ps-2 pe-1 pb-1 ratio-unstyled-all">
                                            @foreach ($product->tags->take(2) as $tag)
                                                <div class="btn-padding ms-1 tag-badge d-flex align-items-center badge">
                                                    {{ $tag->name }} </div>
                                            @endforeach
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div
                                class="swiper-button-next border border-primary w-51 h-51 end-5  rounded-circle d-none d-lg-flex">
                                <svg width="21" height="22" viewBox="0 0 21 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 21L20 11M20 11L10 0.999999M20 11L7.41552e-07 11" stroke="#277CEA" />
                                </svg>
                            </div>
                            <div
                                class="swiper-button-prev border border-primary w-51 h-51 start-5  rounded-circle d-none d-lg-flex">
                                <svg width="21" height="22" viewBox="0 0 21 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 1L0.999998 11M0.999998 11L11 21M0.999998 11L21 11" stroke="#277CEA" />
                                </svg>
                            </div>
                            <div class="swiper-pagination d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </main>
@endsection

<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-form">
        <livewire:form-contact type="contact">
    </div>
</div>
