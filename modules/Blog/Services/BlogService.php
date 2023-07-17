<?php

namespace Ellite\Blog\Services;

use Ellite\Blog\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Ellite\Blog\Models\PageBlog;
use Ellite\Blog\Models\PostCategory;
use Illuminate\Support\Facades\DB;

class BlogService
{
    private $page;

    public function __construct()
    {
        $this->page = PageBlog::withTranslation()->firstOrCreate();
    }

    public function getPage()
    {
        return $this->page;
    }

    private function postQuery($with_translation = true)
    {
        $posts = Post::where('active', 1)
            ->where(
                fn (Builder $q) => $q->whereNull('publish_date')
                    ->orWhere('publish_date', '<=', now())
            )->with('categories');

        if ($with_translation) {
            $posts = $posts->withTranslation();
        }

        return $posts;
    }

    public function getPosts(int $quantity = 12, string $category = null)
    {
        $posts = $this->postQuery()->orderByDesc('post_date');

        if ($category) {
            $category = PostCategory::withTranslation()->whereTranslation('slug', $category)->first();
            $posts->whereRelation('categories', 'posts_categories.id', $category->id);
        }

        $posts = $posts->paginate($quantity);

        return $posts;
    }

    public function getPost(string $slug)
    {
        // DB::enableQueryLog();

        $post = $this->postQuery()
            ->whereTranslation('slug', $slug);

        // dd(DB::getQueryLog());
        // DB::disableQueryLog();

        return $post->firstOrFail();
    }

    public function hasPosts()
    {
        return $this->postQuery(false)->count() > 0;
    }

    public function getCategories()
    {
        $categories = PostCategory::whereActive(1)->withTranslation()->has('posts')->get();
        return $categories;
    }
}
