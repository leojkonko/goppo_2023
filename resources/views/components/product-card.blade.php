@props(['product'])

<a href="{{ route_lang('detalhe', ['id' => $product->id]) }}">
    @if ($product->categories->count())
        <div class="cor">
            <span>{{ $product->categories[0]->name }}</span>
        </div>
    @endif

    @if ($product->image->first())
        <img src="{{ $product->image->first()->url() }}" alt="{{ $product->title }}">
    @endif

    @if ($product->code)
        <div class="span bg-white">
            <span>{{ $product->code }}</span>
        </div>
    @endif
</a>
