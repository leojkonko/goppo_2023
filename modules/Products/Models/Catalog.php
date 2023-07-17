<?php

namespace Ellite\Products\Models;

use App\Ellite\ElliteModel;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Catalog extends ElliteModel implements TranslatableContract
{
    use Translatable;

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'catalogs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public $translatedAttributes = [
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
    
    public function images() {
        return $this->attachment('file_catalogs');
    }

    public function file() {
        return $this->attachment('file_catalogs');
    }

    public function getLogName()
    {
        return '';
    }
    
    public static function getEntityNameSingular()
    {
        return 'catálogo';
    }

    public static function getEntityNamePlural()
    {
        return 'catálogos';
    }

    public static function getArticle()
    {
        return 'o';
    }
}
