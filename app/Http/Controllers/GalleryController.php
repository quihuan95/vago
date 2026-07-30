<?php

namespace App\Http\Controllers;

use App\Services\FilesystemGallery;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GalleryController extends Controller
{
    public function __construct(private FilesystemGallery $gallery) {}

    public function index(): View
    {
        $albums = $this->gallery->albums();

        return view('pages.gallery.index', compact('albums'));
    }

    public function show(string $slug): View
    {
        $album = $this->gallery->find($slug);

        if (! $album) {
            throw new NotFoundHttpException;
        }

        return view('pages.gallery.show', compact('album'));
    }
}
