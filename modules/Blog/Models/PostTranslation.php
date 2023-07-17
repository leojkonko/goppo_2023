<?php

namespace Ellite\Blog\Models;

use App\Ellite\ElliteModel;

class PostTranslation extends ElliteModel
{    
    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'posts_translations';

   public $hasSlug = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'title',
        'slug',
        'short_title',
        'description',
        'keywords',
        'text',
        'short_text',
        'video',
        'hits',
    ];
}
