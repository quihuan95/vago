@extends('layouts.app')

@section('title', $album->title.' — VAGO')
@section('description', $album->description ?: __('site.gallery_title'))

@section('content')
    @include('partials.page-hero', [
        'title' => $album->title,
        'subtitle' => $album->event_date,
    ])

    @include('partials.breadcrumb', ['items' => [
        ['label' => __('site.gallery_title'), 'url' => route('gallery.index')],
        ['label' => $album->title],
    ]])

    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        @if ($album->description)
            <p class="max-w-3xl text-lg leading-relaxed text-muted">{{ $album->description }}</p>
        @endif

        @if ($album->images->isEmpty())
            <p class="mt-12 text-center text-muted">{{ __('site.no_images') }}</p>
        @else
            <div class="mt-10 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4" data-lightbox-gallery>
                @foreach ($album->images as $index => $image)
                    <button
                        type="button"
                        class="group relative aspect-square overflow-hidden rounded-sm bg-vago/10"
                        data-lightbox-trigger
                        data-lightbox-index="{{ $index }}"
                        data-lightbox-src="{{ $image->url }}"
                        data-lightbox-caption="{{ $image->caption }}"
                        aria-label="{{ __('site.gallery_view_album') }}"
                    >
                        <img
                            src="{{ $image->url }}"
                            alt="{{ $image->alt }}"
                            class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                            loading="lazy"
                        >
                    </button>
                @endforeach
            </div>
        @endif
    </div>

    <div id="lightbox" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/90 p-4" role="dialog" aria-modal="true">
        <button type="button" data-lightbox-close aria-label="Close" class="absolute right-4 top-4 rounded-full bg-white/10 p-2 text-white hover:bg-white/20">
            <svg class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
        </button>
        <button type="button" data-lightbox-prev aria-label="Previous" class="absolute left-2 top-1/2 -translate-y-1/2 rounded-full bg-white/10 p-2 text-white hover:bg-white/20 sm:left-6">
            <svg class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 010 1.06L8.06 11l4.73 4.71a.75.75 0 11-1.06 1.06l-5.25-5.25a.75.75 0 010-1.06l5.25-5.25a.75.75 0 011.06 0z" clip-rule="evenodd"/></svg>
        </button>
        <button type="button" data-lightbox-next aria-label="Next" class="absolute right-2 top-1/2 -translate-y-1/2 rounded-full bg-white/10 p-2 text-white hover:bg-white/20 sm:right-6">
            <svg class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 010-1.06L11.94 9 7.21 4.29a.75.75 0 111.06-1.06l5.25 5.25a.75.75 0 010 1.06l-5.25 5.25a.75.75 0 01-1.06 0z" clip-rule="evenodd"/></svg>
        </button>
        <figure class="max-h-[85vh] max-w-4xl">
            <img id="lightbox-image" src="" alt="" class="max-h-[80vh] w-auto rounded-sm object-contain">
            <figcaption id="lightbox-caption" class="mt-3 text-center text-sm text-white/80"></figcaption>
        </figure>
    </div>
@endsection
