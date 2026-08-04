<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Post;
use App\Support\Vago2026;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $banners = Banner::active()->get();

        $featuredPosts = Post::query()
            ->published()
            ->featured()
            ->with('category')
            ->latest('published_at')
            ->take(5)
            ->get();

        if ($featuredPosts->isEmpty()) {
            $featuredPosts = Post::query()
                ->published()
                ->with('category')
                ->latest('published_at')
                ->take(5)
                ->get();
        }

        $announcementCategory = Category::query()
            ->published()
            ->where('slug_vi', 'thong-bao')
            ->first();

        $announcements = $announcementCategory
            ? Post::query()
                ->published()
                ->where('category_id', $announcementCategory->id)
                ->latest('published_at')
                ->take(5)
                ->get()
            : collect();

        return view('pages.home', [
            'banners' => $banners,
            'featuredPosts' => $featuredPosts,
            'announcements' => $announcements,
            'vago2026Url' => Vago2026::url(),
        ]);
    }
}
