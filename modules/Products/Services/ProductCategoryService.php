<?php

namespace Ellite\Products\Services;

use Ellite\Products\Models\ProductCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ProductCategoryService
{
    private $page;
    

    private function categoryQuery($with_translation = true)
    {
        $category = ProductCategory::where('active', 1)
            ->where(
                fn(Builder $q) => $q->whereNull('publish_date')
                    ->orWhere('publish_date', '<=', now())
            );
        
        if ($with_translation) {
            $category = $category->withTranslation();
        }

        return $category;
    }

    public function getCategories(
        int $quantity = 12,
    )
    {
        $categories = $this->categoryQuery();
        
		$categories = $categories->paginate($quantity);
		
        return $categories;
    }

    public function getProductCategory(string $slug)
    {
        $category = $this->categoryQuery();
        
        return $category->firstOrFail();
    }

    public function hasProductCategories()
    {
        return $this->categoryQuery(false)->count() > 0;
    }
}
