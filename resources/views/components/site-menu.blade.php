{{-- @inject('products', 'Ellite\\Products\\Services\\ProductService')

@php
    $categories = $products->getCategories()->get();
@endphp

@if ($categories->count())
    @if ($type === 'footer')
        @foreach ($categories as $category)
            <li>
                <a href="{{ route_lang('products.category', ['category' => $category->slug]) }}">
                    {{ $category->title }}
                </a>
            </li>
        @endforeach
    @else
        <li class="dropdown">
            <button class="dropdown-button gap-0-50">Produtos
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="flecha w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </button>
            <ul class="dropdown-content">
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route_lang('products.category', ['category' => $category->slug]) }}">
                            {{ $category->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
    @endif
@endif --}}

<nav class="menu">
    <ul class="mb-0 list-unstyled d-flex flex-column flex-lg-row align-items-lg-center gap-1 gap-lg-2">
        <li>
            <a href="{{ route_lang('home') }}" title="Home" class="@if (Route::is('home')) active @endif">Home</a>
        </li>
        <li>
            <a href="{{ route_lang('company') }}" title="Empresa" class="@if (Route::is('company')) active @endif">Empresa</a>
        </li>
        @if (app(Ellite\Blog\Services\BlogService::class)->hasPosts())
            <li>
                <a href="{{ route_lang('blog') }}" title="Blog" class="@if (Route::is('blog')) active @endif">Blog</a>
            </li>
        @endif
        <li>
            <a href="{{ route_lang('contact') }}" title="Contato" class="@if (Route::is('contact')) active @endif">Contato</a>
        </li>
    </ul>
</nav>
