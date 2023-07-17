<?php

namespace Ellite\Brands\Models;

use App\Ellite\ElliteModel;

class BrandTranslation extends ElliteModel
{    
    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'brands_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'title',
        'link',
        'text_link',
    ];
}
