@if ($paginator->hasPages())
    <div class="pagination d-flex justify-content-between align-items-center gap-3">
        
        @if (!$paginator->onFirstPage())
            {{-- <li class="page-item">
                <a class="" href="{{ $paginator->url(1) }}" aria-label="Ir para a primeira página" title="Ir para a primeira página">
                    Primeira
                </a>
            </li> --}}
            
             <div class="pagination-item">
                <a class="" href="{{ $paginator->previousPageUrl() }}" aria-label="Ir para a página anterior" title="Ir para a página anterior">
                    <div class="pagination-arrow">
                        <svg width="21" height="22" viewBox="0 0 21 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M11 0.999998L0.999998 11M0.999998 11L11 21M0.999998 11L21 11"
                                stroke="#277CEA" />
                        </svg>
                    </div>
                </a>
            </div>
        @endif

        @php
            $pages = $paginator->getUrlRange(
                max(1, $paginator->currentPage() - 2),
                min($paginator->lastPage(), $paginator->currentPage() + 2)
            );
        @endphp

        @foreach ($pages as $page => $url)
            <div class="pagination-item {{ $page != $paginator->currentPage() ?: "active" }}">
                <a href="{{ $url }}" class="">
                    {{ $page }}
                </a>
            </div>
        @endforeach

        @if ($paginator->hasMorePages())
            <div class="pagination-item">
                <a class="" href="{{ $paginator->nextPageUrl() }}" aria-label="Ir para a próxima página" >
                    <div class="pagination-arrow">
                        <svg width="21" height="22" viewBox="0 0 21 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 21L20 11M20 11L10 0.999999M20 11L7.41552e-07 11" stroke="#277CEA" />
                        </svg>
                    </div>
                    {{-- <div class="swiper-button-next w-51 h-51 border border-white rounded-circle bg-rgb">
                        <svg width="21" height="22" viewBox="0 0 21 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 21L20 11M20 11L10 0.999999M20 11L7.41552e-07 11" stroke="white" />
                        </svg>
                    </div> --}}
                </a>
            </div>
            
            {{-- <li class="page-item">
                <a class="" href="{{ $paginator->url($paginator->lastPage()) }}" aria-label="Ir para a última página">
                    Última
                </a>
            </li> --}}
        @endif 
    </div>
@endif 
