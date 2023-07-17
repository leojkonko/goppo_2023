<?php

namespace Ellite\Products;

use Illuminate\Support\Facades\Route;
// use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Ellite\Products\Services\ProductService;
use Ellite\Products\Services\CatalogsService;

class ProductsServiceProvider extends ServiceProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        ProductService::class => ProductService::class,
        ProductCategoryService::class => ProductCategoryService::class,
        CatalogsService::class => CatalogsService::class,
    ];

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }
}
