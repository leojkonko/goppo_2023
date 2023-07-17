@props(['post'])

<div class="blog-card d-flex flex-column shadow overflow-hidden bg-white rounded-3 h-100 position-relative">
    @if ($post->image->count())
        <div class="ratio ratio-16x9">
            <img class="object-fit-cover" src="{{ $post->image->first()->url() }}" alt="{{ $post->title }}">
            <div class="loader position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                <div class="spinner-border fs-4 text-secondary"></div>
                <span class="fw-normal text-secondary">
                    Carregando imagem...
                </span>
            </div>
            @if ($post->categories->count())
                <div class="m-0-50 d-flex gap-0-50 align-items-start justify-content-start">
                    @foreach ($post->categories as $category)
                        <span class="badge bg-secondary">{{ $category->name }}</span>
                    @endforeach
                </div>
            @endif
        </div>
    @endif
    <div class="blog-card-body p-1">
        <span class="small text-muted">
            {{ $post->post_date?->format('d/m/Y') }}
        </span>
        <h3 class="blog-card-title mt-0-50 mb-0">
            {{ $post->title }}
        </h3>
        <p class="blog-card-description mt-0-50 mb-0">
            {{ $post->short_text }}
        </p>
    </div>
    <a href="{{ route_lang('blog.details', ['slug' => $post->slug]) }}" class="stretched-link" aria-label="" title="{{ $post->title }}"></a>
</div>
