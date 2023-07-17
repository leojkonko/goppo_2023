<?php

namespace App\Http\Controllers;

use App\Services\SiteService;
use Ellite\Blog\Models\PostCategory;
use Ellite\Blog\Services\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request, SiteService $site, BlogService $blog)
    {
        $site
            ->setAlternates('blog')
            ->pushBreadCrumb('Blog')
            ->setBreadTitle('Blog')
            ->setTitle('Blog')
            ->setDescriptionIfNotEmpty($blog->getPage()->description)
            ->setKeywordsIfNotEmpty($blog->getPage()->keywords);

        $posts = $blog->getPosts(
            quantity: 12,
            category: $request->categoria
        );

        $categories = $blog->getCategories();

        // necessário para a paginação manter os parâmetros GET
        $posts->appends(request()->input());

        return view('front.pages.blog', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    public function details(SiteService $site, BlogService $blog, string $slug)
    {
        $site
            ->pushBreadCrumb('Blog', route_lang('blog'))
            ->setDescriptionIfNotEmpty($blog->getPage()->description)
            ->setKeywordsIfNotEmpty($blog->getPage()->keywords);

        $post = $blog->getPost($slug);

        $site
            ->setAlternates('blog.details', $post)
            ->setTitle($post->title)
            ->pushBreadCrumb($post->short_title ?: $post->title)
            ->setBreadTitle($post->short_title ?: $post->title)
            ->setDescriptionIfNotEmpty($post->description)
            ->setKeywordsIfNotEmpty($post->keywords)
            ->setMetasSocials($post, $post->image, 'article');

        return view('front.pages.blog-details', [
            'post' => $post,
        ]);
    }
}
