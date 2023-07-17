@extends('front.layout.app')

@section('content')
    <main id="produto" class="pt-2" style="overflow-x:hidden; min-height: 50rem">

        <section class="">
            <div class="container">
                <div class="row">
                    {{-- <div class="col-xl-4 col-lg-4"> --}}
                    {{-- <livewire:products-filter :applicationSlug="request()->input('application')" :categorySlug="request()->input('category')" /> --}}
                    {{-- </div> --}}

                    <form class="col-xl-3 col-lg-4 pb-1" action="{{ route_lang('products') }}">
                        <div class="p-lg-2 p-1" style="border: #d2d2d2 solid 1px">
                            <div class="input-group mb-3">
                                <input type="text" class="text-white form-control border-bottom searchbar-text"
                                    style="background: none; color: black" placeholder="Busque por produtos"
                                    value="{{ request('search') }}" name="search" aria-label=""
                                    aria-describedby="basic-addon2">
                                <button class="button-unstyled2" id="basic-addon2">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.4357 12.4357L19 19M14.4008 7.70039C14.4008 11.4009 11.4009 14.4008 7.70039 14.4008C3.99987 14.4008 1 11.4009 1 7.70039C1 3.99987 3.99987 1 7.70039 1C11.4009 1 14.4008 3.99987 14.4008 7.70039Z"
                                            stroke="black" stroke-miterlimit="10" />
                                    </svg>
                                </button>
                            </div>

                            <div class="accordion" id="accordionExample-3">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button p-16 p-700 text-dark-claro" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true"
                                            aria-controls="collapseThree">
                                            Linhas
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree">
                                        <div class="accordion-body">
                                            <ul class="list-unstyled mb-0 p-0 d-flex flex-column gap-0-50 px-0-50 py-1">
                                                @foreach ($applications as $index => $line)
                                                    <li class="">
                                                        <div
                                                            class="d-flex align-items-center gap-0-50 justify-content-between">
                                                            <div class="d-flex align-items-center gap-0-50">
                                                                <p class="p-14 p-400 text-white">{{ $line->name }}</p>
                                                            </div>
                                                            <div>
                                                                <input type="radio" id="opcao{{ $index }}-3" name="application" class="input-radio input-radio-filter"
                                                                    @if (request('application') === $line->slug) checked @endif value="{{ $line->slug }}"> 
                                                                <label for="opcao{{ $index }}-3" class="radio-label mb-2"></label>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFour">
                                        <button class="accordion-button p-16 p-700 text-dark-claro collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false"
                                            aria-controls="collapseFour">
                                            Marcas
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse mt-2"
                                        aria-labelledby="headingFour">
                                        <div class="accordion-body">
                                            <ul class="list-unstyled mb-0 p-0 d-flex flex-column gap-0-50 px-0-50 py-1">
                                                @foreach ($categories as $index => $brand)
                                                    <li class="">
                                                        <div
                                                            class="d-flex align-items-center gap-0-50 justify-content-between">
                                                            <div class="d-flex align-items-center gap-0-50">
                                                                <p class="p-14 p-400 text-white">{{ $brand->name }}</p>
                                                            </div>
                                                            <div>
                                                                <input type="radio" id="opcao{{ $index }}-4"
                                                                    name="category" class="input-radio"
                                                                    @if (request('category') === $brand->slug) checked @endif
                                                                    value="{{ $brand->slug }}">
                                                                <label for="opcao{{ $index }}-4"
                                                                    class="radio-label mb-2"></label>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            {{-- <a href="{{ route('products') }}">
                                <button class="mt-2 btn btn-primary text-white rounded-0">Buscar</button>
                            </a> --}}
                        </div>
                    </form>


                    <div class="col-xl-9 col-lg-8 col-12">
                        <div class="ps-lg-4 pb-2">
                            <div class="d-flex flex-column flex-lg-row justify-content-center">
                                <h2
                                    class="title h2-40 p-400 text-dark w-100 text-center d-flex d-lg-block align-items-center justify-content-center text-lg-start pb-2">
                                    Produtos
                                    <svg class="ms-2" width="200" height="3" viewBox="0 0 200 3" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect x="200" y="0.5" width="2.00001" height="200"
                                            transform="rotate(90 200 0.5)" fill="#f0611f" />
                                    </svg>
                                </h2>
                                @if (count($filters))
                                    <div
                                        class="d-flex col-lg-4 align-items-center justify-content-start justify-content-lg-end gap-1">
                                        Filtrado por:

                                        @foreach ($filters as $filter)
                                            <a href="{{ route('products') }}">
                                                <button class="h-fit-content btn btn-light rounded-0">{{ $filter['title'] }}
                                                    <svg class="ms-0-50" width="12" height="12" viewBox="0 0 12 12"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1 1L11 11M11 1L1 11" stroke="#505050" />
                                                    </svg>
                                                </button>
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            @if ($page->catalog->first())
                                <div class="row mt-1">
                                    <a href="{{ $page->catalog->first()->url() }}">
                                        <div class="ratio ratio-4x1 mb-2">
                                            <img class="object-fit-cover w-100 h-100"
                                                src="{{ $page->images->first()->url() }}" alt="">
                                        </div>
                                    </a>
                                </div>
                            @endif
                            <div class="row">
                                @foreach ($products as $index => $product)
                                    <div class="col-lg-4 d-flex flex-column col-6">
                                        <a href="{{ route_lang('detalhe', ['id' => $product->id]) }}"
                                            class="ratio ratio-1x1 bg-white p-1 position-relative overflow-hidden a-produtos product-border">
                                            @if ($product->image()->first())
                                                <img class="object-fit-cover w-100 h-100 produtos-hover"
                                                    src="{{ $product->image()->first()->url() }}" alt="">
                                            @endif
                                            <div class="d-flex bottom-0 start-0 pb-1 ratio-unstyled-all">
                                                @foreach ($product->tags->take(2) as $tag)
                                                    <div
                                                        class="btn-padding me-0-50 tag-badge d-flex align-items-center badge">
                                                        {{ $tag->name }} </div>
                                                @endforeach
                                            </div>
                                        </a>
                                        <div class="d-flex bottom-0 start-0 pt-1 pb-2 ratio-unstyled-all px-1">
                                            <p class="flex-column p-16 p-400 m-0 text-dark">
                                                <span class="p-700 fs-6">{{ $product->name }}</span><br>
                                                @if ($product->applications->first())
                                                    {{ $product->applications->first()->name }}
                                                @endif
                                            </p>
                                            <div
                                                class="d-flex bottom-0 end-0 ratio-unstyled-all justify-content-end align-items-center ms-auto">
                                                <button
                                                    class="arrow-btn btn-padding ms-auto btn btn-outline-primary rounded-0 text-dark h-fit-content p-0-50 square-button">
                                                    <svg width="22" height="21" viewBox="0 0 21 24"
                                                        style="color: #0855a0" stroke="currentColor"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10 21L20 11M20 11L10 0.999999M20 11L7.41552e-07 11"
                                                            stroke="currentColor" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row py-2">
                                <div class="col-12 d-flex justify-content-center justify-content-lg-end">
                                    <x-pagination :list="$products" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- <x-catalog-card tipo="produtos" />

        <section class="busca">
            <div class="container">
                <form method="GET" action="{{ route_lang('products') }}">
                    <div class="row">
                        <div class="div-button2">
                            <button class="btn btn-outline-black btn-busca" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                                <img src="{{ url('/site/dist/images/icones/filtro.svg') }}" alt=""> Filtre sua
                                Busca
                            </button>
                        </div>
                        <div class="col-12 d-flex alinhamento">
                            <div class="div-input">
                                <input type="text" name="busca" id="" placeholder="Busque por código">
                                <button type="submit">
                                    <img src="{{ url('/site/dist/images/icones/lupa-produtos.svg') }}" alt="">
                                </button>
                            </div>
                            <div class="div-button">
                                <button class="btn btn-outline-black btn-busca" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                                    <img src="{{ url('/site/dist/images/icones/filtro.svg') }}" alt=""> Filtre
                                    sua
                                    Busca
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section> --}}

        {{-- <section class="cards">
            <div class="container">
                @if ($products->count())
                    <div class="page active" id="page-1">
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-2 cards-conteudo">
                                    <x-product-card :product="$product" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="container pb-4 mb-4" style="margin-left:5%">
                        <p>
                            Nenhum produto encontrado.
                        </p>
                    </div>
                @endif

                <div class="row py-2">
                    <div class="col-12 d-flex justify-content-center">
                        <x-pagination :list="$products" />
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- Modal -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Filtros:</h5>
                <div class="d-flex">
                    <button type="button" class="btn-close text-reset button-cor" data-bs-dismiss="offcanvas"
                        aria-label="Close">X</button>
                </div>
            </div>
            <div class="offcanvas-body">
                @foreach ($categories as $category)
                    <div class="col-12 d-flex justify-content-center py-1">
                        <a href="{{ route_lang('products.category', [$category->slug]) }}"
                            class="btn btn-custom btn-categorias">{{ $category->title }}</a>
                    </div>
                @endforeach
            </div>
        </div>
        <!--modal -->
        <nav aria-label="Page navigation example">
    </main>
@endsection
