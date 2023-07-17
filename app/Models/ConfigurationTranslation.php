<?php

namespace App\Models;

use App\Ellite\ElliteModel;

class ConfigurationTranslation extends ElliteModel
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'configurations_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'description',
        'keywords',
        'custom_js_head',
        'custom_js_body',
    ];
}
