<?php

namespace Ellite\Brands\Models;

use App\Ellite\ElliteModel;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Brand extends ElliteModel implements TranslatableContract
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

    public $translatedAttributes = [
        'title',
        'link',
        'text_link',
    ];
    
    public function image() {
        return $this->attachment('image_brand');
    }

    public function getLogName()
    {
        return $this->name;
    }
    
    public static function getEntityNameSingular()
    {
        return 'marca';
    }

    public static function getEntityNamePlural()
    {
        return 'marcas';
    }

    public static function getArticle()
    {
        return 'a';
    }
}
