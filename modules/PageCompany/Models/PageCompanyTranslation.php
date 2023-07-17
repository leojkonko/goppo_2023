<?php

namespace Ellite\PageCompany\Models;

use App\Ellite\ElliteModel;

class PageCompanyTranslation extends ElliteModel
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'pages_companies_translations';

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
        'text_mission',
        'text_vision',
        'text_values',
        'text_principles',
        'video',
        'video_1',
        'video_2',
        'video_3',
        'video_4',
        'count_up',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'count_up' => 'array',
    ];
}
