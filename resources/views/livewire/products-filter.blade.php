<div class="filtro bg-light py-lg-1 px-lg-1 px-xxl-2 py-xxl-2">
    {{-- Componentes Livewire devem ter apenas um elemento raiz --}}
    
        <div wire:loading>
            {{__("Carregando")}}...
        </div>
    
        <button class="toggle-filtro btn btn-primary d-flex align-items-center gap-0-50 d-lg-none w-100 z-index-3 position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFiltros" aria-controls="offcanvasFiltros">
            <svg fill="currentColor" class="w-1-25 h-1-25" width="20" height="20" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <path d="M30 6.749h-28c-0.69 0-1.25 0.56-1.25 1.25s0.56 1.25 1.25 1.25v0h28c0.69 0 1.25-0.56 1.25-1.25s-0.56-1.25-1.25-1.25v0zM24 14.75h-16c-0.69 0-1.25 0.56-1.25 1.25s0.56 1.25 1.25 1.25v0h16c0.69 0 1.25-0.56 1.25-1.25s-0.56-1.25-1.25-1.25v0zM19 22.75h-6.053c-0.69 0-1.25 0.56-1.25 1.25s0.56 1.25 1.25 1.25v0h6.053c0.69 0 1.25-0.56 1.25-1.25s-0.56-1.25-1.25-1.25v0z"></path>
            </svg>
            {{__('Filtrar produtos')}}
        </button>
        <form class="offcanvas-lg offcanvas-end bg-light" tabindex="-1" id="offcanvasFiltros" aria-labelledby="offcanvasFiltrosLabel" method="get" action="{{ route_lang('products') }}">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasFiltrosLabel">{{__('Filtrar produtos')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasFiltros" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column gap-1">
    
                <div class="search-form w-100 position-relative" action="" class="position-relative">
                    <input type="text" value="{{ request()->input('search') }}" placeholder="{{__('Busque por tipo, linha ou código')}}" class="form-control" name="search">
                    <button type="submit" class="d-flex btn p-0">
                        <svg class="w-1 h-1" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.4357 12.4357L19 19M14.4008 7.70039C14.4008 11.4009 11.4009 14.4008 7.70039 14.4008C3.99987 14.4008 1 11.4009 1 7.70039C1 3.99987 3.99987 1 7.70039 1C11.4009 1 14.4008 3.99987 14.4008 7.70039Z" stroke="currentColor" stroke-miterlimit="10" />
                        </svg>
                    </button>
                </div>
    
                @if ($this->applications?->hasChildren())
                    <x-product-relation-filter 
                        :node="$this->applications"
                        prefix="applications"
                        title="{{ __('Linhas') }}"
                        livewirefield="applicationSlug"
                        fieldname="application"
                        :opened="!empty($this->applicationSlug)"
                    />
                @endif
    
                @if ($this->categories?->hasChildren())
                    <x-product-relation-filter 
                        :node="$this->categories"
                        prefix="categories"
                        title="{{ __('Marcas') }}"
                        livewirefield="categorySlug"
                        fieldname="category"
                        :opened="!empty($this->categorySlug)"
                    />
                @endif
                
                <button type="submit" class="d-flex text-uppercase text-center justify-content-center btn btn-outline-primary">
                    {{__("Buscar")}}
                </button>
            </div>
        </form>
    </div>
    