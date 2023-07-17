<?php

namespace Ellite\Products\Models;

use App\Ellite\ElliteModel;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class PageProduct extends ElliteModel implements TranslatableContract
{
    use Translatable;

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'pages_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];

    public $translatedAttributes = [
        'description',
        'keywords',
        'text',
        'text_1',
        'text_2',
        'text_3',
        'text_4',
        'video',
        'video_1',
        'video_2',
        'video_3',
        'video_4',
    ];
    
    public function images() {
        return $this->attachment('image_page_product');
    }

    public function catalog() {
        return $this->attachment('general_catalog');
    }

    public function getLogName()
    {
        return '';
    }
    
    public static function getEntityNameSingular()
    {
        return 'página de produtos';
    }

    public static function getEntityNamePlural()
    {
        return 'páginas de produtos';
    }

    public static function getArticle()
    {
        return 'o';
    }
}
