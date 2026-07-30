<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use App\Models\TrainingProgram;
use App\Services\FilesystemGallery;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = collect([
            ['loc' => route('home'), 'lastmod' => now()],
            ['loc' => route('about.gioi-thieu-chung'), 'lastmod' => now()],
            ['loc' => route('about.thu-chu-tich'), 'lastmod' => now()],
            ['loc' => route('about.ban-chap-hanh'), 'lastmod' => now()],
            ['loc' => route('training.index'), 'lastmod' => now()],
            ['loc' => route('member.the-le'), 'lastmod' => now()],
            ['loc' => route('member.register'), 'lastmod' => now()],
            ['loc' => route('gallery.index'), 'lastmod' => now()],
            ['loc' => route('news.thong-bao'), 'lastmod' => now()],
            ['loc' => route('news.hoat-dong'), 'lastmod' => now()],
            ['loc' => route('contact.show'), 'lastmod' => now()],
        ]);

        Post::published()->get()->each(function (Post $post) use ($urls) {
            $urls->push([
                'loc' => route('news.show', $post->slug_vi),
                'lastmod' => $post->updated_at,
            ]);
        });

        Page::published()->get()->each(function (Page $page) use ($urls) {
            $urls->push([
                'loc' => url('/'.trim($page->slug_vi, '/')),
                'lastmod' => $page->updated_at,
            ]);
        });

        app(FilesystemGallery::class)->albums()->each(function ($album) use ($urls) {
            $urls->push([
                'loc' => route('gallery.show', $album->slug),
                'lastmod' => now(),
            ]);
        });

        TrainingProgram::published()->get()->each(function (TrainingProgram $program) use ($urls) {
            $urls->push([
                'loc' => route('training.show', $program->slug_vi),
                'lastmod' => $program->updated_at,
            ]);
        });

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
