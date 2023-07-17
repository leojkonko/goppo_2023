<?php

namespace Ellite\Products\Models;

use App\Ellite\ElliteModel;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Orchid\Filters\Filterable;

class ProductCategory extends ElliteModel implements TranslatableContract
{
    use Translatable, Filterable;

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'products_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'active',
        'order',
    ];

    public $translatedAttributes = [
        'title',
        'text_1',
        'slug',
        'description',
        'keywords',
    ];

    public function getLogName()
    {
        return $this->name;
    }
    
    public static function getEntityNameSingular()
    {
        return 'marca de produto';
    }

    public static function getEntityNamePlural()
    {
        return 'marcas de produtos';
    }

    public static function getArticle()
    {
        return 'a';
    }
    
    public function products()
    {
        return $this->belongsToMany(Product::class, 'rel_products_categories', 'product_category_id', 'product_id');
    }
}
