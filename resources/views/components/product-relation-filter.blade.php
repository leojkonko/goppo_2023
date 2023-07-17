<div>
    <button class="btn btn-primary w-100 d-flex justify-content-between align-items-center gap-1 collapse-toggle {{ !$opened ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $prefix }}" aria-expanded="{{ $opened ? 'true' : 'false' }}" aria-controls="collapse{{ $prefix }}">
        {{ $title }}
        <svg class="arrow w-1-25 h-1-25" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M5 9.00525L10 14.0052L15 9.00525" stroke="currentColor" stroke-width="1.5" />
        </svg>
    </button>
    <div class="collapse {{ $opened ? 'show' : '' }}" id="collapse{{ $prefix }}">
        <ul class="list-unstyled mb-0 p-0 d-flex flex-column gap-0-50 px-0-50 py-1">
            @foreach ($node->children as $child)
                <li class="">
                    <div class="d-flex align-items-center gap-0-50 justify-content-between">
                        {{-- Verificar se foi criado recentemente, caso for, adicionar a tag small abaixo --}}
                        <div class="d-flex align-items-center gap-0-50">
                            @if ($child->object->created_at && $child->object->created_at->isSameWeek(Carbon\Carbon::now()))
                                <small class="fw-bold text-primary">NOVO</small>
                            @endif
                            <label for="{{ $prefix }}-{{ $child->object->id }}">{{ $child->object->title }}</label>
                        </div>
                        <input class="form-check-input flex-0" type="radio" name="{{ $fieldname }}" value="{{ $child->object->slug }}" id="{{ $prefix }}-{{ $child->object->id }}">
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
