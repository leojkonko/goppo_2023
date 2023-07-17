<?php

namespace Ellite\Blog\Models;

use App\Ellite\ElliteModel;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Orchid\Filters\Filterable;

class PostCategory extends ElliteModel implements TranslatableContract
{
    use Translatable, Filterable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts_categories';

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
        'title',
        'slug',
        'description',
        'keywords',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'rel_posts_categories', 'post_category_id', 'post_id');
    }

    public function getLogName()
    {
        return $this->name;
    }

    public static function getEntityNameSingular()
    {
        return 'categoria de artigo';
    }

    public static function getEntityNamePlural()
    {
        return 'categorias de artigos';
    }

    public static function getArticle()
    {
        return 'a';
    }
}
