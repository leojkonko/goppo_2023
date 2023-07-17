<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use App\Services\SiteService;
use Ellite\Contact\Services\ContactService;

class ContactController extends Controller
{
    public function index(SiteService $site, ContactService $page)
    {
        $site->setAlternates('contact')
            ->pushBreadCrumb('Contato')
            ->setBreadTitle('Contato')
            ->setTitle('Contato')
            ->setDescriptionIfNotEmpty($page->getPage()->description)
            ->setKeywordsIfNotEmpty($page->getPage()->keywords);
        
        return view('front.pages.contact', [
            'contact' => $page
        ]);
    }
}
