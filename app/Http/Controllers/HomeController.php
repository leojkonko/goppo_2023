<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use App\Services\SiteService;
use Ellite\Banners\Services\BannersService;
use Ellite\PageHome\Services\PageHomeService;
use Ellite\Products\Services\ProductService;

class HomeController extends Controller
{
    public function index(SiteService $alternates, BannersService $banners, ProductService $products, PageHomeService $home)
    {
        $alternates->setAlternates('home');
        
        return view('front.pages.home', [
            'header_home' => true,
            'banners' => $banners->getBanners(),
            'products' => $products,
            'page_home' => $home->getPage(),
        ]);
    }
}
