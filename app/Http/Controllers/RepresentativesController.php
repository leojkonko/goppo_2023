<?php

namespace App\Http\Controllers;

use App\Services\SiteService;
use Ellite\PageCompany\Services\OurHistoryService;
use Ellite\PageCompany\Services\PageCompanyService;

class RepresentativesController extends Controller
{
    public function index(SiteService $site, PageCompanyService $page, OurHistoryService $ourHistoryService)
    {
        $site->setAlternates('representatives')
            ->setTitle('Representates')
            ->setBreadTitle('Representates')
            ->pushBreadCrumb('Representates')
            ->setDescriptionIfNotEmpty($page->getPage()->description)
            ->setKeywordsIfNotEmpty($page->getPage()->keywords);

        return view('front.pages.representatives', [
            'page' => $page->getPage(),
            'ourHistories' => $ourHistoryService->getOurHistory(),
        ]);
    }
}
