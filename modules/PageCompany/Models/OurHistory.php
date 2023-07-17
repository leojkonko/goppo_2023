<?php

namespace Ellite\PageCompany\Models;

use App\Ellite\ElliteModel;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class OurHistory extends ElliteModel implements TranslatableContract
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

    protected $table = 'our_histories';

    public $translatedAttributes = [
        'title_1',
        'title_2',
        'title_3',
        'title_4',
        'text_1',
        'text_2',
        'text_3',
        'text_4',
    ];
    
    public function image() {
        return $this->attachment('image_ourhistory');
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
