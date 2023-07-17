<?php

namespace Ellite\Products\Models;

use App\Ellite\ElliteModel;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Orchid\Filters\Filterable;

class Product extends ElliteModel implements TranslatableContract
{
    use Translatable, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'weight',
        'height',
        'width',
        'length',
        'price',
        'featured',
        'active',
        'order',
    ];

    public $translatedAttributes = [
        'title',
        'slug',
        'short_title',
        'description',
        'keywords',
        'text',
        'text_1',
        'text_2',
        'text_3',
        'short_text',
        'video',
        'hits',
        'color',
        'product_id',
        'locale',
    ];
    
    public function image() {
        return $this->attachment('image_product');
    }

    public function catalog() {
        return $this->attachment('product_catalog');
    }

    public function getLogName()
    {
        return $this->name;
    }
    
    public static function getEntityNameSingular()
    {
        return 'produto';
    }

    public static function getEntityNamePlural()
    {
        return 'produtos';
    }

    public static function getArticle()
    {
        return 'o';
    }

    protected $sync = [
        'categories' => 'categories',
        'applications' => 'applications',
        'related' => 'related',
        'tags' => 'tags'
    ];

    /**
     * Name of columns to which http filter can be applied
     *
     * @var array
     */
    protected $allowedFilters = [
        'name',
        'code',
    ];

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'rel_products_categories', 'product_id', 'product_category_id');
    }

    public function applications()
    {
        return $this->belongsToMany(ProductApplication::class, 'rel_products_applications', 'product_id', 'product_application_id');
    }
    public function tags()
    {
        return $this->belongsToMany(ProductTag::class, 'rel_products_tags', 'product_id', 'product_tag_id');
    }
    public function related()
    {
        return $this->belongsToMany(Product::class, 'rel_related_products', 'product_id', 'related_id');
    }
}
