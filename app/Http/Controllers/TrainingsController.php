<?php

namespace App\Http\Controllers;

use App\Services\SiteService;
use Ellite\PageTrainings\Services\PageTrainingsService;

class TrainingsController extends Controller
{
    public function index(SiteService $site, PageTrainingsService $page)
    {
        $site
            ->setAlternates('trainings')
            ->pushBreadCrumb('Treinamento')
            ->setBreadTitle('Treinamento')
            ->setTitle('Treinamento')
            ->setDescriptionIfNotEmpty($page->getPage()->description)
            ->setKeywordsIfNotEmpty($page->getPage()->keywords);

        return view('front.pages.trainings', [
            'page' => $page->getPage(),
        ]);
    }
}
