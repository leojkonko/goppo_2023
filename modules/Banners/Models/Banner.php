<?php

namespace Ellite\Banners\Models;

use App\Ellite\ElliteModel;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Banner extends ElliteModel implements TranslatableContract
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
    
    public function bannerDesktop() {
        return $this->attachment('desktop_banner');
    }
    public function bannerMobile() {
        return $this->attachment('mobile_banner');
    }

    public function getLogName()
    {
        return $this->name;
    }
    
    public static function getEntityNameSingular()
    {
        return 'banner';
    }

    public static function getEntityNamePlural()
    {
        return 'banners';
    }

    public static function getArticle()
    {
        return 'o';
    }

    public function getImagemDesktop()
    {
        return $this->bannerDesktop->first();
    }

    public function getImagemMobile()
    {
        return $this->bannerMobile->count() 
            ? $this->bannerMobile->first()
            : $this->getImagemDesktop();
    }
}
