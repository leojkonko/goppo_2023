<?php

namespace Ellite\Products\Models;

use App\Ellite\ElliteModel;

class ProductTranslation extends ElliteModel
{    
    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'products_translations';
   
   public $hasSlug = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
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
}
