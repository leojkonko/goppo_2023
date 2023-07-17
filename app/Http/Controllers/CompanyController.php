<?php

namespace App\Http\Controllers;

use App\Services\SiteService;
use Ellite\PageCompany\Services\OurHistoryService;
use Ellite\PageCompany\Services\PageCompanyService;

class CompanyController extends Controller
{
    public function index(SiteService $site, PageCompanyService $page, OurHistoryService $ourHistoryService)
    {
        $site->setAlternates('company')
            ->setTitle('Sobre a empresa')
            ->setBreadTitle('Sobre a empresa')
            ->pushBreadCrumb('Sobre a empresa')
            ->setDescriptionIfNotEmpty($page->getPage()->description)
            ->setKeywordsIfNotEmpty($page->getPage()->keywords);

        return view('front.pages.company', [
            'page' => $page->getPage(),
            'ourHistories' => $ourHistoryService->getOurHistory(),
        ]);
    }
}
