<?php

namespace App\Http\Controllers;

use App\Services\SiteService;
use Ellite\Products\Services\ProductService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(SiteService $alternates, ProductService $products, Request $request)
    {
        $request->only(['application']);
        $categories = $products->getCategories();
        $applications = $products->getApplications();
        $tags = $products->getTags();
        $filters = [];

        $search = request('search');

        $view = $products->getProducts(20, $search);

        if ($search) {
            array_push($filters, [
                'title' => request('search'),
                'type' => 'search'
            ]);
        }

        $alternates
            ->setAlternates('products')
            ->pushBreadCrumb('Produtos', route_lang('products'))
            ->setBreadTitle('Produtos')
            ->setTitle('Produtos')
            ->setDescriptionIfNotEmpty($products->getPage()->description)
            ->setKeywordsIfNotEmpty($products->getPage()->keywords);

        $category = request('category');

        if ($category) {
            $category = $products->getCategory($category);
            $alternates
                ->setAlternates('products', $category)
                ->pushBreadCrumb($category->title)
                ->setBreadTitle($category->title)
                ->setTitle($category->title)
                ->setDescriptionIfNotEmpty($category->description)
                ->setKeywordsIfNotEmpty($category->keywords);
            array_push($filters, [
                'title' => $category->title,
                'type' => 'category'
            ]);
        } else {
            $category = null;
        }

        $application = request('application');

        if ($application) {
            $application = $products->getApplication($application);

            $alternates
                ->setAlternates('products', $application)
                ->pushBreadCrumb($application->title)
                ->setBreadTitle($application->title)
                ->setTitle($application->title)
                ->setDescriptionIfNotEmpty($application->description)
                ->setKeywordsIfNotEmpty($application->keywords);
            array_push($filters, [
                'title' => $application->title,
                'type' => 'application'
            ]);
        } else {
            $application = null;
        }

        // $view = $products->getProducts(20, null, $category, null);
        // $view = $products->getProducts(20, null, null, $application);
        $view = $products->getProducts(20, $search, $category, $application);

        return view('front.pages.products', [
            'products' => $view,
            'categories' => $categories,
            'applications' => $applications,
            'tags' => $tags,
            'filters' => $filters,
            'page' => $products->getPage()
        ]);
    }


    public function details(SiteService $alternates, ProductService $products)
    {
        $alternates
            ->pushBreadCrumb('Produtos', route_lang('products'))
            ->setDescriptionIfNotEmpty($products->getPage()->description)
            ->setKeywordsIfNotEmpty($products->getPage()->keywords);

        $id = request('id');
        $product = $products->getProduct($id);

        $alternates
            ->setAlternates('blog.details', $product)
            ->setTitle($product->title)
            ->pushBreadCrumb($product->short_title ?: $product->title)
            ->setBreadTitle($product->short_title ?: $product->title)
            ->setDescriptionIfNotEmpty($product->description)
            ->setKeywordsIfNotEmpty($product->keywords)
            ->setMetasSocials($product, $product->image, 'article');

            $relatedProducts = $products->getRelatedProducts($product);

        return view('front.pages.products-details', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
    public function detalhe(SiteService $alternates, ProductService $products)
    {
        $categories = $products->getCategories();

        $alternates
            ->setAlternates('products')
            ->pushBreadCrumb('Produtos', route_lang('products'))
            ->setBreadTitle('Produtos')
            ->setTitle('Produtos')
            ->setDescriptionIfNotEmpty($products->getPage()->description)
            ->setKeywordsIfNotEmpty($products->getPage()->keywords);

        $slug = request('slug');

        $category = request('category');

        if ($category) {
            $category = $products->getCategory($category);

            $alternates
                ->setAlternates('products.category', $category)
                ->pushBreadCrumb($category->title)
                ->setBreadTitle($category->title)
                ->setTitle($category->title)
                ->setDescriptionIfNotEmpty($category->description)
                ->setKeywordsIfNotEmpty($category->keywords);
        } else {
            $category = null;
        }

        $search = request('busca');

        $product = $products->getProduct($slug);

        $view = $products->getProducts(20, $search, $category);

        return view('front.pages.products-details', [
            'products' => $view,
            'product' => $slug,
            'categories' => $categories,
        ]);
    }
}
