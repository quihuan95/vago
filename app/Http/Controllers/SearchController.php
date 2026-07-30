<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use App\Models\TrainingProgram;
use App\Services\FilesystemGallery;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $query = trim((string) $request->get('q', ''));
        $perPage = 10;
        $page = max((int) $request->get('page', 1), 1);

        $results = collect();

        if ($query !== '') {
            $results = $this->searchPosts($query)
                ->concat($this->searchPages($query))
                ->concat($this->searchAlbums($query))
                ->concat($this->searchTraining($query))
                ->sortByDesc('date')
                ->values();
        }

        $paginated = new Paginator(
            $results->forPage($page, $perPage),
            $results->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('pages.search', [
            'query' => $query,
            'results' => $paginated,
        ]);
    }

    protected function searchPosts(string $query): Collection
    {
        return Post::query()
            ->published()
            ->where(function ($q) use ($query) {
                $q->where('title_vi', 'like', "%{$query}%")
                    ->orWhere('title_en', 'like', "%{$query}%")
                    ->orWhere('excerpt_vi', 'like', "%{$query}%")
                    ->orWhere('excerpt_en', 'like', "%{$query}%");
            })
            ->latest('published_at')
            ->take(30)
            ->get()
            ->map(fn (Post $post) => [
                'type' => __('site.search_type_post'),
                'title' => $post->t('title'),
                'excerpt' => $post->t('excerpt'),
                'image' => $post->featured_image,
                'date' => $post->published_at,
                'url' => route('news.show', $post->localizedSlug() ?: $post->slug_vi),
            ]);
    }

    protected function searchPages(string $query): Collection
    {
        return Page::query()
            ->published()
            ->where(function ($q) use ($query) {
                $q->where('title_vi', 'like', "%{$query}%")
                    ->orWhere('title_en', 'like', "%{$query}%")
                    ->orWhere('excerpt_vi', 'like', "%{$query}%")
                    ->orWhere('excerpt_en', 'like', "%{$query}%");
            })
            ->latest('updated_at')
            ->take(30)
            ->get()
            ->map(fn (Page $page) => [
                'type' => __('site.search_type_page'),
                'title' => $page->t('title'),
                'excerpt' => $page->t('excerpt'),
                'image' => $page->featured_image,
                'date' => $page->published_at ?? $page->updated_at,
                'url' => $this->pageUrl($page),
            ]);
    }

    protected function searchAlbums(string $query): Collection
    {
        $needle = mb_strtolower($query);

        return app(FilesystemGallery::class)
            ->albums()
            ->filter(function ($album) use ($needle) {
                return str_contains(mb_strtolower($album->title), $needle)
                    || str_contains(mb_strtolower((string) $album->description), $needle)
                    || str_contains(mb_strtolower($album->slug), $needle);
            })
            ->take(30)
            ->map(fn ($album) => [
                'type' => __('site.search_type_album'),
                'title' => $album->title,
                'excerpt' => $album->description,
                'image' => null,
                'date' => null,
                'url' => route('gallery.show', $album->slug),
            ])
            ->values();
    }

    protected function searchTraining(string $query): Collection
    {
        return TrainingProgram::query()
            ->published()
            ->where(function ($q) use ($query) {
                $q->where('title_vi', 'like', "%{$query}%")
                    ->orWhere('title_en', 'like', "%{$query}%")
                    ->orWhere('excerpt_vi', 'like', "%{$query}%")
                    ->orWhere('excerpt_en', 'like', "%{$query}%");
            })
            ->latest('starts_at')
            ->take(30)
            ->get()
            ->map(fn (TrainingProgram $program) => [
                'type' => __('site.search_type_training'),
                'title' => $program->t('title'),
                'excerpt' => $program->t('excerpt'),
                'image' => $program->featured_image,
                'date' => $program->starts_at,
                'url' => route('training.show', $program->localizedSlug() ?: $program->slug_vi),
            ]);
    }

    protected function pageUrl(Page $page): string
    {
        $slug = $page->localizedSlug() ?: $page->slug_vi;

        return match ($page->type) {
            'thu-chu-tich' => route('about.thu-chu-tich'),
            'the-le' => route('member.the-le'),
            default => route('about.gioi-thieu-chung'),
        };
    }
}
