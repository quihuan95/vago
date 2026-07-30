<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Support\Locale;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NewsController extends Controller
{
    public function thongBao(): View
    {
        return $this->listByCategorySlug('thong-bao', __('site.nav_news_announcement'));
    }

    public function hoatDong(): View
    {
        return $this->listByCategorySlug('hoat-dong', __('site.nav_news_activity'));
    }

    protected function listByCategorySlug(string $slug, string $heading): View
    {
        $category = Category::query()
            ->published()
            ->where('slug_vi', $slug)
            ->orWhere('slug_en', $slug)
            ->first();

        $posts = Post::query()
            ->published()
            ->when($category, fn ($query) => $query->where('category_id', $category->id))
            ->latest('published_at')
            ->paginate(9);

        return view('pages.news.index', [
            'posts' => $posts,
            'heading' => $heading,
            'activeSlug' => $slug,
            'category' => $category,
        ]);
    }

    public function show(string $slug): View
    {
        $post = Post::query()
            ->published()
            ->with('category')
            ->where('slug_'.Locale::current(), $slug)
            ->first();

        if (! $post) {
            $post = Post::query()
                ->published()
                ->with('category')
                ->where('slug_vi', $slug)
                ->orWhere('slug_en', $slug)
                ->first();
        }

        if (! $post) {
            throw new NotFoundHttpException;
        }

        $related = Post::query()
            ->published()
            ->where('id', '!=', $post->id)
            ->when($post->category_id, fn ($query) => $query->where('category_id', $post->category_id))
            ->latest('published_at')
            ->take(4)
            ->get();

        return view('pages.news.show', compact('post', 'related'));
    }
}
