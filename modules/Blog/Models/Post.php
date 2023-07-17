<?php

namespace Ellite\Blog\Models;

use App\Ellite\ElliteModel;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Orchid\Filters\Filterable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Post extends ElliteModel implements TranslatableContract
{
    use Translatable, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'active',
        'order',
        'post_date',
        'publish_date',
        'publish_time',
    ];

    public $translatedAttributes = [
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

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'post_date' => 'immutable_date',
        'publish_date' => 'immutable_date',
        'publish_time' => 'immutable_date',
    ];
    
    /**
     * Name of columns to which http filter can be applied
     *
     * @var array
     */
    protected $allowedFilters = [
        'name',
        'post_date',
        'publish_date',
    ];

    public function image() {
        return $this->attachment('image_post');
    }

    public function getLogName()
    {
        return $this->name;
    }
    
    public static function getEntityNameSingular()
    {
        return 'artigo';
    }

    public static function getEntityNamePlural()
    {
        return 'artigos';
    }

    public static function getArticle()
    {
        return 'o';
    }
    
    protected $sync = [
        'categories' => 'categories',
    ];

    public function categories()
    {
        return $this->belongsToMany(PostCategory::class, 'rel_posts_categories', 'post_id', 'post_category_id');
    }

    protected function postDateFieldValue(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->post_date?->format('Y-m-d'),
        );
    }
    
    protected function publishDateFieldValue(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->publish_date?->format('Y-m-d'),
        );
    }
}
