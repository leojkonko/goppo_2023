<?php

namespace Ellite\PageCompany\Models;

use App\Ellite\ElliteModel;

class OurHistoryTranslation extends ElliteModel
{    
    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'our_histories_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'title_1',
        'title_2',
        'title_3',
        'title_4',
        'text_1',
        'text_2',
        'text_3',
        'text_4',
    ];
}
