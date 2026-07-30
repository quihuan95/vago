<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;

class FilesystemGallery
{
    private const EXTENSIONS = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

    public function basePath(): string
    {
        return public_path('galleries');
    }

    /**
     * @return Collection<int, object{
     *     slug: string,
     *     title: string,
     *     description: ?string,
     *     cover_url: ?string,
     *     image_count: int,
     *     event_date: ?string
     * }>
     */
    public function albums(): Collection
    {
        $base = $this->basePath();

        if (! File::isDirectory($base)) {
            return collect();
        }

        return collect(File::directories($base))
            ->map(fn (string $dir) => $this->albumFromDirectory($dir))
            ->filter()
            ->sortBy('title', SORT_NATURAL | SORT_FLAG_CASE)
            ->values();
    }

    public function find(string $slug): ?object
    {
        $dir = $this->basePath().DIRECTORY_SEPARATOR.$slug;

        if (! File::isDirectory($dir)) {
            return null;
        }

        return $this->albumFromDirectory($dir, withImages: true);
    }

    private function albumFromDirectory(string $dir, bool $withImages = false): ?object
    {
        $slug = basename($dir);
        $images = $this->imagesIn($dir);

        if ($images->isEmpty()) {
            return null;
        }

        $meta = $this->readMeta($dir);
        $title = $meta['title'] ?? $this->titleFromSlug($slug);
        $cover = $meta['cover'] ?? $images->first();

        $album = (object) [
            'slug' => $slug,
            'title' => $title,
            'description' => $meta['description'] ?? null,
            'cover_url' => $this->publicUrl($slug, $cover),
            'image_count' => $images->count(),
            'event_date' => $meta['event_date'] ?? null,
            'images' => collect(),
        ];

        if ($withImages) {
            $album->images = $images->values()->map(fn (string $filename, int $index) => (object) [
                'url' => $this->publicUrl($slug, $filename),
                'alt' => $title.' — '.($index + 1),
                'caption' => null,
            ]);
        }

        return $album;
    }

    /**
     * @return Collection<int, string>
     */
    private function imagesIn(string $dir): Collection
    {
        return collect(File::files($dir))
            ->filter(fn (SplFileInfo $file) => in_array(strtolower($file->getExtension()), self::EXTENSIONS, true))
            ->sortBy(fn (SplFileInfo $file) => $file->getFilename())
            ->values()
            ->map(fn (SplFileInfo $file) => $file->getFilename());
    }

    /**
     * @return array{title?: string, description?: string, cover?: string, event_date?: string}
     */
    private function readMeta(string $dir): array
    {
        $path = $dir.DIRECTORY_SEPARATOR.'album.json';

        if (! File::exists($path)) {
            return [];
        }

        $data = json_decode(File::get($path), true);

        return is_array($data) ? $data : [];
    }

    private function titleFromSlug(string $slug): string
    {
        return Str::of($slug)->replace(['-', '_'], ' ')->title()->toString();
    }

    private function publicUrl(string $slug, string $filename): string
    {
        return asset('galleries/'.$slug.'/'.$filename);
    }
}
