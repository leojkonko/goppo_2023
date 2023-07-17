@extends('front.layout.app')

@section('content')
    <main id="blog" class="overflow-hidden py-2 py-lg-4">
        <section class="busca">
            <div class="container">
                <div class="row g-2">

                    @if (count($categories))
                        <div class="col-12">
                            <button class="btn btn-primary d-flex align-items-center gap-0-50" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCategorias" aria-controls="offcanvasCategorias">
                                <svg class="w-1-25 h-1-25" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M10 18h4v-2h-4v2zM3 6v2h18V6H3zm3 7h12v-2H6v2z" />
                                </svg>
                                Categorias
                            </button>
                            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasCategorias" aria-labelledby="offcanvasCategoriasLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="offcanvasCategoriasLabel">Categorias</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <p>Selecione uma categoria:</p>
                                    <ul class="list-unstyled mb-0 p-0">
                                        @foreach ($categories as $category)
                                            <li>
                                                <a href="{{ route_lang('blog', ['categoria' => $category->slug]) }}" class="@if (route_lang('blog', ['categoria' => $category->slug]) === Request::fullUrl()) active @endif">{{ $category->name }}</a>
                                            </li>
                                        @endforeach
                                        <li>
                                            <a href="{{ route_lang('blog') }}" class="fw-bold">Ver todos</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($posts->count())
                        @foreach ($posts as $post)
                            <div class="col-6 col-lg-4 col-xl-3">
                                <x-blog-card :post="$post" />
                            </div>
                        @endforeach
                    @else
                        <p>
                            Nenhum artigo encontrado.
                        </p>
                    @endif
                </div>
            </div>
            @if ($posts->total() > $posts->perPage())
                <div class="row py-2">
                    <div class="col-12 d-flex justify-content-center">
                        <x-pagination :list="$posts" />
                    </div>
                </div>
            @endif
        </section>

    </main>
@endsection
