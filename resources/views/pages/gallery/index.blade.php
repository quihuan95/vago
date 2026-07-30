@extends('layouts.app')

@section('title', __('site.gallery_title').' — VAGO')
@section('description', 'Thư viện ảnh hoạt động khoa học và sự kiện của Hội Phụ sản Việt Nam (VAGO).')

@section('content')
    @include('partials.page-hero', [
        'title' => __('site.gallery_title'),
        'subtitle' => null,
    ])

    @include('partials.breadcrumb', ['items' => [
        ['label' => __('site.gallery_title')],
    ]])

    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        @if ($albums->isEmpty())
            <div class="rounded-md border border-dashed border-vago/30 bg-white/60 px-8 py-16 text-center">
                <p class="font-display text-xl font-semibold text-vago-deep">{{ __('site.updating') }}</p>
                <p class="mt-3 text-sm text-muted">{{ __('site.no_albums') }}</p>
            </div>
        @else
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($albums as $album)
                    <a href="{{ route('gallery.show', $album->slug) }}" class="card group flex flex-col">
                        <div class="aspect-[4/3] overflow-hidden bg-vago/10">
                            @if ($album->cover_url)
                                <img src="{{ $album->cover_url }}" alt="{{ $album->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                            @endif
                        </div>
                        <div class="flex flex-1 flex-col p-5">
                            <h3 class="font-display text-lg font-semibold text-vago-deep group-hover:text-vago">{{ $album->title }}</h3>
                            @if ($album->event_date)
                                <p class="mt-1 text-xs font-medium uppercase tracking-wide text-muted">{{ __('site.gallery_event_date') }}: {{ $album->event_date }}</p>
                            @endif
                            @if ($album->description)
                                <p class="mt-3 flex-1 text-sm leading-relaxed text-muted">{{ \Illuminate\Support\Str::limit($album->description, 110) }}</p>
                            @endif
                            <span class="mt-4 text-sm font-semibold text-vago">{{ __('site.gallery_view_album') }} →</span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
