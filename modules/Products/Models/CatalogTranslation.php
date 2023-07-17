<?php

namespace Ellite\Products\Models;

use App\Ellite\ElliteModel;

class CatalogTranslation extends ElliteModel
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'catalogs_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
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
}
