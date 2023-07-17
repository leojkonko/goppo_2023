<?php

namespace Ellite\Products\Models;

use App\Ellite\ElliteModel;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class ProductApplication extends ElliteModel implements TranslatableContract
{
    use Translatable;

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


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products_applications';

    public $translatedAttributes = [
        'title',
        'text_1',
        'slug',
    ];
    
    public function image() {
        return $this->attachment('image_product_application');
    }

    public function getLogName()
    {
        return $this->name;
    }
    
    public static function getEntityNameSingular()
    {
        return 'linha';
    }

    public static function getEntityNamePlural()
    {
        return 'linha';
    }

    public static function getArticle()
    {
        return 'a';
    }
}
