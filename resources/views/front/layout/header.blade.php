<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <x-custom-code type="head" />
    <x-lgpd-head-script />

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Agência Ellite Digital">

    {{-- Favicons --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('front/images/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('front/images/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('front/images/favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('front/images/favicons/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('front/images/favicons/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    {{-- Fonte temporária --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- Swiper.js --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.2.0/swiper-bundle.min.css"
        integrity="sha512-Ja1oxinMmERBeokXx+nbQVVXeNX771tnUSWWOK4mGIbDAvMrWcRsiteRyTP2rgdmF8bwjLdEJADIwdMXQA5ccg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Fancybox --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />

    {{--  --}}

    {{-- Front css --}}
    @vite(['resources/front/sass/vendors/bootstrap/bootstrap.scss', 'resources/front/sass/main.scss'])

    <x-head-tags />
    @livewireStyles
    @inject('products', 'Ellite\\Products\\Services\\ProductService')
</head>
<!-- offcanvas -->

<!-- offcanvas -->
<div class="offcanvas offcanvas-end bg-dark-claro" tabindex="-1" id="offcanvasRight"
    aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <button type="button" class="button-unstyled text-reset text-white" data-bs-dismiss="offcanvas"
            aria-label="Close">
            <svg class="me-0-50" width="11" height="12" viewBox="0 0 11 12" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M6 1L1 6M1 6L6 11M1 6H11" stroke="white" />
            </svg>
            Voltar
        </button>
    </div>
    <div class="offcanvas-body">
        <form class="col-12" action="{{ route_lang('products') }}">
            <div class="bg-dark-claro p-lg-2 p-1">
                <div class="input-group mb-3">
                    <input type="text" class="text-white form-control form-search pesquisa"
                        placeholder="Busque por produtos" value="{{ request('search') }}" name="search"
                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <button class="button-unstyled2" id="basic-addon2">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.4357 12.4357L19 19M14.4008 7.70039C14.4008 11.4009 11.4009 14.4008 7.70039 14.4008C3.99987 14.4008 1 11.4009 1 7.70039C1 3.99987 3.99987 1 7.70039 1C11.4009 1 14.4008 3.99987 14.4008 7.70039Z"
                                stroke="white" stroke-miterlimit="10" />
                        </svg>
                    </button>
                </div>

                <div class="accordion" id="accordionExample-3">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button p-16 p-700 text-dark-claro collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                aria-controls="collapseOne">
                                Linhas
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne">
                            <div class="accordion-body">
                                <ul class="list-unstyled mb-0 p-0 d-flex flex-column gap-0-50 px-0-50 py-1">
                                    @foreach ($products->getApplications() as $index => $line)
                                        <li class="">
                                            <div class="d-flex align-items-center gap-0-50 justify-content-between">
                                                <div class="d-flex align-items-center gap-0-50">
                                                    <p class="p-14 p-400 text-white">{{ $line->name }}</p>
                                                </div>
                                                <div>
                                                    <input type="radio" id="opcao{{ $index }}-1"
                                                        name="application" class="input-radio"
                                                        @if (request('application') === $line->slug) checked @endif
                                                        value="{{ $line->slug }}">
                                                    <label for="opcao{{ $index }}-1"
                                                        class="radio-label mb-2"></label>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button p-16 p-700 text-dark-claro collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                aria-controls="collapseTwo">
                                Marcas
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse mt-2" aria-labelledby="headingTwo">
                            <div class="accordion-body">
                                <ul class="list-unstyled mb-0 p-0 d-flex flex-column gap-0-50 px-0-50 py-1">
                                    @foreach ($products->getCategories() as $index => $brand)
                                        <li class="">
                                            <div
                                                class="d-flex align-items-center gap-0-50 justify-content-between">
                                                <div class="d-flex align-items-center gap-0-50">
                                                    <p class="p-14 p-400 text-white">{{ $brand->name }}</p>
                                                </div>
                                                <div>
                                                    <input type="radio" id="opcao{{ $index }}-2"
                                                        name="category" class="input-radio"
                                                        @if (request('category') === $brand->slug) checked @endif
                                                        value="{{ $brand->slug }}">
                                                    <label for="opcao{{ $index }}-2"
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
                <a href="{{ route('products') }}">
                    <button class="mt-2 btn btn-primary text-white rounded-0">Buscar</button>
                </a>
            </div>
        </form>
    </div>
</div>


<div class="offcanvas offcanvas-start bg-primary" tabindex="-1" id="offcanvasHeader"
    aria-labelledby="offcanvasHeaderLabel">
    <div class="offcanvas-header">
        <button type="button" class="button-unstyled text-reset text-white" data-bs-dismiss="offcanvas"
            data-bs-target="#offcanvasHeader" aria-label="Close">
            <svg class="me-0-50" width="11" height="12" viewBox="0 0 11 12" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M6 1L1 6M1 6L6 11M1 6H11" stroke="white" />
            </svg>
            Voltar
        </button>
    </div>
    <div class="offcanvas-body position-relative">
        <div>
            <ul class="m-0 list-unstyled ps-2">
                <li class="mt-1">
                    <a class="p-26 p-700 text-decoration-none text-white" href="{{ route_lang('home') }}">Home</a>
                </li>
                <li class="mt-1">
                    <a class="p-26 p-700 text-decoration-none text-white" href="{{ route_lang('company') }}">Sobre</a>
                </li>
                <li class="mt-1">
                    <a href="" class="p-26 p-700 text-decoration-none text-white" type="button"
                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                        Produtos</a>
                </li>
                <li class="mt-1">
                    <a class="p-26 p-700 text-decoration-none text-white"
                        href="{{ route_lang('contact') }}">Contato</a>
                </li>
                <div class="infos-header ps-2  position-absolute bottom-0 mb-4">
                    <a href="">
                        <img src="{{ asset('front/images/logos/logo.png') }}" alt="">
                    </a>
                    <div class="d-flex gap-1 ps-2 pt-2">
                        <a href="" target="_blank">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_31_170)">
                                    <path
                                        d="M12 2.162C15.204 2.162 15.584 2.174 16.849 2.232C18.157 2.292 19.504 2.59 20.457 3.543C21.419 4.505 21.708 5.839 21.768 7.151C21.826 8.416 21.838 8.796 21.838 12C21.838 15.204 21.826 15.584 21.768 16.849C21.709 18.15 21.404 19.51 20.457 20.457C19.495 21.419 18.162 21.708 16.849 21.768C15.584 21.826 15.204 21.838 12 21.838C8.796 21.838 8.416 21.826 7.151 21.768C5.86 21.709 4.482 21.397 3.543 20.457C2.586 19.5 2.292 18.153 2.232 16.849C2.174 15.584 2.162 15.204 2.162 12C2.162 8.796 2.174 8.416 2.232 7.151C2.291 5.855 2.599 4.487 3.543 3.543C4.503 2.583 5.842 2.292 7.151 2.232C8.416 2.174 8.796 2.162 12 2.162ZM12 0C8.741 0 8.332 0.014 7.052 0.072C5.197 0.157 3.355 0.673 2.014 2.014C0.668 3.36 0.157 5.198 0.072 7.052C0.014 8.332 0 8.741 0 12C0 15.259 0.014 15.668 0.072 16.948C0.157 18.801 0.675 20.648 2.014 21.986C3.359 23.331 5.2 23.843 7.052 23.928C8.332 23.986 8.741 24 12 24C15.259 24 15.668 23.986 16.948 23.928C18.802 23.843 20.646 23.326 21.986 21.986C23.333 20.639 23.843 18.802 23.928 16.948C23.986 15.668 24 15.259 24 12C24 8.741 23.986 8.332 23.928 7.052C23.843 5.197 23.326 3.354 21.986 2.014C20.643 0.671 18.797 0.156 16.948 0.072C15.668 0.014 15.259 0 12 0Z"
                                        fill="white" fill-opacity="0.5" />
                                    <path
                                        d="M12 5.83801C8.597 5.83801 5.838 8.59701 5.838 12C5.838 15.403 8.597 18.162 12 18.162C15.403 18.162 18.162 15.403 18.162 12C18.162 8.59701 15.403 5.83801 12 5.83801ZM12 16C9.791 16 8 14.209 8 12C8 9.79101 9.791 8.00001 12 8.00001C14.209 8.00001 16 9.79101 16 12C16 14.209 14.209 16 12 16Z"
                                        fill="white" fill-opacity="0.5" />
                                    <path
                                        d="M18.406 7.03399C19.2013 7.03399 19.846 6.38928 19.846 5.59399C19.846 4.7987 19.2013 4.15399 18.406 4.15399C17.6107 4.15399 16.966 4.7987 16.966 5.59399C16.966 6.38928 17.6107 7.03399 18.406 7.03399Z"
                                        fill="white" fill-opacity="0.5" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_31_170">
                                        <rect width="24" height="24" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                        <a href="" target="_blank">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_31_175)">
                                    <path
                                        d="M24 12.073C24 18.062 19.606 23.027 13.87 23.928V15.565H16.659L17.19 12.105H13.87V9.86C13.87 8.913 14.334 7.991 15.82 7.991H17.329V5.045C17.329 5.045 15.959 4.811 14.65 4.811C11.916 4.811 10.13 6.468 10.13 9.467V12.104H7.091V15.564H10.13V23.927C4.395 23.025 0 18.061 0 12.073C0 5.446 5.373 0.072998 12 0.072998C18.627 0.072998 24 5.445 24 12.073Z"
                                        fill="white" fill-opacity="0.5" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_31_175">
                                        <rect width="24" height="24" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                        <a href="" target="_blank">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_31_181)">
                                    <path
                                        d="M20.4496 20.4505H16.8933V14.8811C16.8933 13.5529 16.8697 11.8439 15.0436 11.8439C13.1915 11.8439 12.9077 13.2904 12.9077 14.7853V20.4505H9.35258V8.99709H12.767V10.5618H12.8143C13.5109 9.37202 14.8047 8.6612 16.1825 8.71206C19.7873 8.71206 20.4508 11.0834 20.4508 14.1668L20.4496 20.4505ZM5.33977 7.43118C4.19967 7.43118 3.27601 6.50747 3.27601 5.36733C3.27601 4.22719 4.19967 3.30349 5.33977 3.30349C6.47987 3.30349 7.40354 4.22719 7.40354 5.36733C7.40354 6.50747 6.47987 7.43118 5.33977 7.43118ZM7.11733 20.4505H3.55748V8.99709H7.11733V20.4505ZM22.2224 0.00134427H1.77046C0.804218 -0.00930019 0.0118267 0.76538 0 1.73166V22.2684C0.0118267 23.2358 0.804218 24.0105 1.77046 23.9999H22.2224C23.1911 24.0117 23.987 23.237 24 22.2684V1.73048C23.9858 0.761831 23.1899 -0.0128484 22.2224 0.000161495"
                                        fill="white" fill-opacity="0.5" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_31_181">
                                        <rect width="24" height="24" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                    </div>
                </div>
        </div>
    </div>
</div>

<body>
    <x-custom-code type="body" />

    <header class="header w-100 top-0 start-0 w-100 position-relative overflow-visible" style="background: #202020">
        <div class="position-relative py-1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-6 justify-content-lg-center justify-content-start">
                        <a class="d-flex py-1" href="{{ route('home') }}" title="Página principal" style="width: fit-content">
                            <img class="logo-header" width="250px" src="{{ asset('front/images/logos/logo.png') }}"
                                alt="Logo {{ env('APP_NAME') }}">
                        </a>
                    </div>
                    <div class="col-lg-8 d-flex justify-content-center d-none d-lg-flex">
                        <ul class="list-unstyled d-flex mb-0 gap-lg-3">
                            <li class="item-header">
                                <a href="{{ route('home') }}"
                                    class="text-decoration-none text-white link-header link-header-home">Home</a>
                            </li>
                            <li class="item-header">
                                <a href="{{ route('company') }}"
                                    class="text-decoration-none text-white link-header link-header-sobre-a-empresa">Sobre</a>
                            </li>
                            <li class="item-header" id="dropdownMenuOffset" data-bs-toggle="dropdown"
                                aria-expanded="false" data-bs-offset="0,40">
                                <a href=""
                                    class="text-decoration-none text-white link-header link-header-produtos"
                                    type="button"> Produtos</a>
                            </li>
                            <li class="item-header">
                                <a href="{{ route('representatives') }}"
                                    class="text-decoration-none text-white link-header link-header-representantes"
                                    type="button"> Representantes</a>
                            </li>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                                @foreach ($products->getApplications() as $index => $line)
                                    <li>
                                        <a class="dropdown-item" href="{{ route_lang('products', ['application' => $line->slug]) }}">{{ $line->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <li class="item-header">
                                <a href="{{ route('contact') }}"
                                    class="text-decoration-none text-white link-header link-header-contato">Contato</a>
                            </li>
                        </ul>
                    </div>


                    {{-- Botão mobile --}}
                    <div class="d-lg-none col-6 justify-content-end d-flex">
                        <button class="btn p-0-50 btn-outline-light" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasHeader" aria-controls="offcanvasHeader">
                            <svg class="" width="2.0em" height="2.0em" xmlns="http://www.w3.org/2000/svg"
                                fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="white">
                                <path stroke-linecap="white" stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    </div>


                </div>
            </div>
            {{-- <svg class="position-absolute start-0 bottom-0 w-100" width="100%" height="2" viewBox="0 0 1920 2"
                fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.000244141 1.00024H1920" stroke="#A6A6A6" />
            </svg> --}}
        </div>
    </header>

    @if (!Route::is('home'))
        <x-breadcrumbs />
    @endif
