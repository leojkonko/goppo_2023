<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Ellite\Products\Services\ProductService;

class ProductsFeatured extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        private ProductService $products,
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
        return view('components.products-featured', [
            'products' => $this->products->getProducts(),
        ]);
    }
}
