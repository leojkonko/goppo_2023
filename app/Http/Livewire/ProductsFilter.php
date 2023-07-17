<?php

namespace App\Http\Livewire;

use Ellite\Products\Services\ProductService;
use Livewire\Component;

class ProductsFilter extends Component
{
    private $applications;
    public $applicationSlug;

    private $categories;
    public $categorySlug;

    private $subcategories;
    public $subcategorySlug;

    private $tags;
    public $tagSlug;

    public $classifications;

    public function render(ProductService $products)
    {
        $tree = $products->getMenuTree();

        $this->applications = $tree;

        if ($this->applicationSlug) {
            $this->categories = $tree->findChildren(
                fn($a) => $a->object->slug === $this->applicationSlug
            );
        }
        
        if ($this->categorySlug) {
            $this->subcategories = $this->categories?->findChildren(
                fn($c) => $c->object->slug === $this->categorySlug
            );
        }

        if ($this->subcategorySlug) {
            $this->tags = $this->subcategories?->findChildren(
                fn($s) => $s->object->slug === $this->subcategorySlug
            );
        }

        // $classifications = $products->getClassifications();

        // $this->classifications = $classifications;

        return view('livewire.products-filter');
    }

    public function updatedApplicationSlug()
    {
        $this->categories = null;
        $this->categorySlug = null;

        $this->subcategories = null;
        $this->subcategorySlug = null;

        $this->tags = null;
        $this->tagSlug = null;
    }

    public function updatedCategorySlug()
    {
        $this->subcategorySlug = null;
        $this->subcategories = null;

        $this->tags = null;
        $this->tagSlug = null;
    }
    
    public function updatedSubcategorySlug()
    {
        $this->tags = null;
        $this->tagSlug = null;
    }
}
