<?php

namespace Ellite\Products\Services;

use Ellite\Products\Models\Catalog;

class CatalogsService
{
    public function hasCatalog()
    {
        $catalog = Catalog::first();
        return $catalog && $catalog->file->count();
    }
    
    public function getCatalog()
    {
        $catalog = Catalog::first();
        return $catalog && $catalog->file->count() ? $catalog : null;
    }
}
