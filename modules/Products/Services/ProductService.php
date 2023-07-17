<?php

namespace Ellite\Products\Services;

use Ellite\Products\Models\Product;
use Ellite\Products\Models\ProductCategory;
use Illuminate\Database\Eloquent\Builder;
use Ellite\Products\Models\PageProduct;
use Ellite\Products\Models\ProductApplication;
use Ellite\Products\Models\ProductTag;
use Ellite\Products\Models\TreeNode;
use Illuminate\Support\Facades\DB;

class ProductService
{
    private $page;

    public function __construct()
    {
        $this->page = PageProduct::withTranslation()->firstOrCreate();
    }

    public function getPage()
    {
        return $this->page;
    }

    public function getProducts(
        int $quantity = 12,
        ?string $search = null,
        $category = null,
        $application = null,

    ) {
        /** @var Builder */
        $products = Product::where('active', 1)
            ->withTranslation()
            ->with([
                'applications',
                'categories',
            ])
            ->orderByDesc('name');

        if ($application) {
            $products->whereRelation('applications', 'product_application_id', $application->id);
        }

        if ($category) {
            $products->whereRelation('categories', 'product_category_id', $category->id);
        }

        if ($search) {
            $products
                ->where(
                    fn ($q) => $q
                        // ->where('code', $search)
                        ->whereTranslationLike('title', '%' . $search . '%')
                );
        }

        $products = $products->paginate($quantity);

        return $products;
    }

    public function getProduct($id)
    {
        $product = Product::where('active', 1)
            ->where('id', $id)
            ->withTranslation()
            ->with([
                'applications',
                'applications.image',
                'categories'
            ]);

        return $product->firstOrFail();
    }

    public function getRelatedProducts(Product $product)
    {
        $related = $product->related()->withTranslation()->get();

        return $related;
    }

    public function getFeaturedProducts(
        int $limit = 6,
    ) {
        $products = Product::where('active', 1)
            ->where('featured', 1)
            // ->withTranslation()
            // ->with([
            // 'classification',])
        ;

        $products = $products->limit($limit);

        return $products->get();
    }

    public function getCategories()
    {
        $categories = ProductCategory::withTranslation()
            ->where('active', 1)
            // ->whereRelation('products', 'active', 1)
            ->orderBy('order');

        return $categories->get();
    }

    public function getApplications()
    {
        $applications = ProductApplication::withTranslation()
            ->where('active', 1)
            // ->whereRelation('products', 'active', 1)
            ->orderBy('order')
            ->get();

        return $applications;
    }

    public function getTags()
    {
        $tags = ProductTag::withTranslation()
            ->where('active', 1)
            // ->whereRelation('products', 'active', 1)
            ->orderBy('order')
            ->get();

        return $tags;
    }

    public function getCategory($slug)
    {

        $category = ProductCategory::withTranslation()
            ->whereTranslation('slug', $slug)
            ->where('active', 1);

        return $category->firstOrFail();
    }
    public function getApplication($slug)
    {

        $application = ProductApplication::withTranslation()
            ->whereTranslation('slug', $slug)
            ->where('active', 1)
            ->firstOrFail();

        return $application;
    }
    public function getMenuTree()
    {
        $tree = DB::select('
            SELECT product_application_id, product_category_id FROM products_relations pr
            INNER JOIN products p ON p.id = pr.product_id
            WHERE p.active = 1
            GROUP BY product_application_id, product_category_id
            ORDER BY product_application_id ASC, product_category_id ASC
        ');

        $applications_ids = array_filter(array_unique(array_column($tree, 'product_application_id')));
        $applications = ProductApplication::whereIn('id', $applications_ids)->orderBy('order')->get();

        $categories_ids = array_filter(array_unique(array_column($tree, 'product_category_id')));
        $categories = ProductCategory::whereIn('id', $categories_ids)->orderBy('order')->get();

        $new_tree = new TreeNode(null);

        foreach ($tree as $node) {

            $application_id = $node->product_application_id;
            if (!$application_id) {
                continue;
            }

            $application = $applications->first(fn ($a) => $a->id == $application_id);

            $node_application = $new_tree->createOrGetChild($application);

            //

            $category_id = $node->product_category_id;
            if (!$category_id) {
                continue;
            }

            $category = $categories->first(fn ($a) => $a->id == $category_id);

            $node_category = $node_application->createOrGetChild($category);
        }

        return $new_tree;
    }
}
