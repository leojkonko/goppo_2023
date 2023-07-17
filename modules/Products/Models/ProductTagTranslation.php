<?php

namespace Ellite\Products\Models;

use App\Ellite\ElliteModel;

class ProductTagTranslation extends ElliteModel
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'products_tags_translations';

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
        'description',
        'keywords',
    ];
}
