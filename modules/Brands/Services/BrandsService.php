<?php

namespace Ellite\Brands\Services;

use Ellite\Brands\Models\Brand;

class BrandsService
{
    public function getBrands(
        int $quantity = 10,
    )
    {
        $brands = Brand::where('active', 1)
            ->withTranslation()
            ->orderBy('order')
            ->paginate($quantity);
        
        $brands = $brands->filter(
            fn($b) => $b->image->count() > 0,
        );
        
        return $brands;
    }
}
