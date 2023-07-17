<?php

namespace Ellite\Differentials\Models;

use App\Ellite\ElliteModel;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Differential extends ElliteModel implements TranslatableContract
{
    use Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'active',
        'order',
    ];

    public $translatedAttributes = [
        'text_1',
        'text_2',
        'text_3',
        'text_4',
        'link_1',
        'link_2',
        'link_3',
        'link_4',
        'text_link_1',
        'text_link_2',
        'text_link_3',
        'text_link_4',
    ];
    
    public function image() {
        return $this->attachment('image_differential');
    }

    public function getLogName()
    {
        return $this->name;
    }
    
    public static function getEntityNameSingular()
    {
        return 'diferencial';
    }

    public static function getEntityNamePlural()
    {
        return 'diferenciais';
    }

    public static function getArticle()
    {
        return 'o';
    }
}
