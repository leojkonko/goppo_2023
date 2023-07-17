<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Ellite\Brands\Services\BrandsService;

class Brands extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        private BrandsService $brands,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.brands', [
            'brands' => $this->brands->getBrands(),
        ]);
    }
}
