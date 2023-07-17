@inject('site', 'App\\Services\\SiteService')

<section class="pt-2 bg-white">
    {{-- {{ (!Route::is('contact') && !Route::is('products') && !Route::is('detalhe')) ? 'bg-white' : 'bg-cinza' }} --}}
    <div class="container">
        <nav aria-label="breadcrumb"
            class="d-flex flex-column flex-sm-row gap-0-50 align-items-center justify-content-between">
            @if ($site->getBreadTitle())
                {{-- <h1 class="h3 mb-0">
                    {{ $site->getBreadTitle() }}
                </h1> --}}
            @endif
            <ol class="breadcrumb d-flex align-items-baseline">
                @foreach ($site->getBreadCrumbs() as $bread)
                    @if ($loop->last)
                        <li class="breadcrumb-item p-14 p-400 active" aria-current="{{ $bread->getText() }}">
                            {{ $bread->getText() }}</li>
                    @else
                        <li class="breadcrumb-item">
                            <a class="p-14 p-400 text-primary text-decoration-none mb-1 d-flex align-items-baseline"
                                href="{{ $bread->getUrl() }}">{{ $bread->getText() }}</a>
                        </li>
                    @endif
                @endforeach
            </ol>
        </nav>
        @if (!Route::is('contact') && !Route::is('products'))
            <h2 class="title h2-40 p-400 text-dark w-100 text-center text-lg-start py-2 m-0">
                {{ $site->getBreadTitle() }}
                <svg class="ms-2" width="200" height="3" viewBox="0 0 200 3" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <rect x="200" y="0.5" width="2.00001" height="200" transform="rotate(90 200 0.5)"
                        fill="#f0611f" />
                </svg>
            </h2>
        @endif
    </div>
</section>
