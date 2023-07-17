<?php

namespace App\Http\Controllers;

use App\Services\SiteService;
use Ellite\Products\Services\CatalogsService;

class CatalogController extends Controller
{
    public function download(SiteService $site, CatalogsService $catalogService)
    {
        $catalog = $catalogService->getCatalog();

        if (!$catalog) {
            abort(404);
        }

        $file = $catalog->file->first();
        
        // $path = $file->physicalPath();

        return redirect($file->url());
    }
}
