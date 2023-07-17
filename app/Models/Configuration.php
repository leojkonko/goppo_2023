<?php

namespace App\Models;

use App\Ellite\ElliteModel;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Configuration extends ElliteModel implements TranslatableContract
{
    use Translatable;

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'configurations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email_authenticated',
        'email_dsn',
        'email_from',
    ];

    public $translatedAttributes = [
        'description',
        'keywords',
        'custom_js_head',
        'custom_js_body',
    ];
    
    public function getLogName()
    {
        return '';
    }
    
    public static function getEntityNameSingular()
    {
        return 'configuração';
    }

    public static function getEntityNamePlural()
    {
        return 'configurações';
    }

    public static function getArticle()
    {
        return 'a';
    }
}
