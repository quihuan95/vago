<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Post;
use App\Models\Setting;
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

        $vago2026Url = Setting::getValue('vago2026_url', 'https://vago2026.websitehoinghi');

        return view('pages.home', [
            'banners' => $banners,
            'featuredPosts' => $featuredPosts,
            'announcements' => $announcements,
            'vago2026Url' => $vago2026Url,
        ]);
    }
}
