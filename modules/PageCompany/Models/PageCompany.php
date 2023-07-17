<?php

namespace Ellite\PageCompany\Models;

use App\Ellite\ElliteModel;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class PageCompany extends ElliteModel implements TranslatableContract
{
    use Translatable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages_companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public $translatedAttributes = [
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

    public function images()
    {
        return $this->attachment('image_page_company');
    }

    public function images_v2()
    {
        return $this->attachment('image_page_company_v2');
    }
    
    public function image_solo()
    {
        return $this->attachment('image_page_company_brief2');
    }

    public function gallery()
    {
        return $this->attachment('image_page_company_gallery');
    }

    public function videoThumbnail()
    {
        return $this->attachment('image_page_company_thumbnail');
    }

    public function getLogName()
    {
        return '';
    }

    public static function getEntityNameSingular()
    {
        return 'página de empresa';
    }

    public static function getEntityNamePlural()
    {
        return 'páginas de empresa';
    }

    public static function getArticle()
    {
        return 'a';
    }
}
