<?php

namespace Ellite\Products\Models;

use App\Ellite\ElliteModel;

class ProductApplicationTranslation extends ElliteModel
{    
    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'products_applications_translations';

   public $hasSlug = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'title',
        'text_1',
        'slug',
    ];
}
