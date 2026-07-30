@extends('layouts.app')

@section('title', $post->t('seo_title') ?: $post->t('title'))
@section('description', $post->t('seo_description') ?: $post->t('excerpt') ?: __('site.updating'))

@section('content')
    @php
        $categoryLabel = $post->category?->t('name');
        $categoryRoute = match ($post->category?->slug_vi) {
            'hoat-dong' => route('news.hoat-dong'),
            default => route('news.thong-bao'),
        };
        $shareUrl = urlencode(url()->current());
        $shareTitle = urlencode($post->t('title'));
    @endphp

    @include('partials.page-hero', [
        'title' => $post->t('title'),
        'subtitle' => $categoryLabel,
    ])

    @include('partials.breadcrumb', ['items' => [
        ['label' => __('site.news_title'), 'url' => route('news.thong-bao')],
        ['label' => $categoryLabel ?: __('site.news_breadcrumb'), 'url' => $categoryRoute],
        ['label' => $post->t('title')],
    ]])

    <div class="mx-auto max-w-4xl px-4 py-16 sm:px-6 lg:px-8">
        <p class="text-xs font-semibold uppercase tracking-wide text-vago">
            {{ __('site.published_at') }}: {{ optional($post->published_at)->format('d/m/Y') }}
        </p>

        @if ($post->featured_image)
            <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->t('title') }}" class="my-8 aspect-[16/9] w-full rounded-md object-cover">
        @endif

        <div class="rich-content max-w-none">
            {!! $post->t('content') ?: '<p>'.__('site.updating').'</p>' !!}
        </div>

        @if ($post->attachment)
            <a href="{{ asset('storage/'.$post->attachment) }}" target="_blank" class="btn-outline mt-8 inline-flex">
                {{ __('site.download_attachment') }}
            </a>
        @endif

        <div class="mt-10 flex items-center gap-3 border-t border-vago/10 pt-6">
            <span class="text-sm font-semibold text-ink">{{ __('site.share') }}:</span>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener" aria-label="Facebook" class="flex h-9 w-9 items-center justify-center rounded-full bg-vago/10 text-vago-dark transition hover:bg-vago/20">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12.06C22 6.5 17.52 2 12 2S2 6.5 2 12.06c0 5 3.66 9.15 8.44 9.94v-7.03H7.9v-2.9h2.54V9.85c0-2.5 1.49-3.89 3.78-3.89 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56v1.88h2.78l-.44 2.9h-2.34V22c4.78-.8 8.44-4.95 8.44-9.94z"/></svg>
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}" target="_blank" rel="noopener" aria-label="X / Twitter" class="flex h-9 w-9 items-center justify-center rounded-full bg-vago/10 text-vago-dark transition hover:bg-vago/20">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M18.9 2H22l-7.6 8.7L23.4 22h-7.1l-5.6-6.9L4.3 22H1.2l8.1-9.3L0.9 2H8.2l5 6.3L18.9 2zm-1.2 18h1.9L7.4 4H5.4l12.3 16z"/></svg>
            </a>
            <a href="mailto:?subject={{ $shareTitle }}&body={{ $shareUrl }}" aria-label="Email" class="flex h-9 w-9 items-center justify-center rounded-full bg-vago/10 text-vago-dark transition hover:bg-vago/20">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M2 5.5A2.5 2.5 0 014.5 3h15A2.5 2.5 0 0122 5.5v13a2.5 2.5 0 01-2.5 2.5h-15A2.5 2.5 0 012 18.5v-13zm2.2.5l7.8 6.2L19.8 6H4.2zM20 8.2l-7.4 5.9a1 1 0 01-1.2 0L4 8.2v10.3h16V8.2z"/></svg>
            </a>
        </div>

        <div class="mt-6">
            <a href="{{ $categoryRoute }}" class="text-sm font-semibold text-vago hover:text-vago-dark">← {{ __('site.back_to_list') }}</a>
        </div>

        @if ($related->isNotEmpty())
            <div class="mt-16 border-t border-vago/10 pt-12">
                <h2 class="font-display text-2xl font-semibold text-vago-deep">{{ __('site.related_posts') }}</h2>
                <div class="mt-6 grid gap-6 sm:grid-cols-2">
                    @foreach ($related as $item)
                        <a href="{{ route('news.show', $item->localizedSlug() ?: $item->slug_vi) }}" class="card group flex gap-4 p-3">
                            <div class="h-20 w-24 shrink-0 overflow-hidden rounded-sm bg-vago/10">
                                @if ($item->featured_image)
                                    <img src="{{ asset('storage/'.$item->featured_image) }}" alt="{{ $item->t('title') }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                                @endif
                            </div>
                            <div class="min-w-0">
                                <p class="text-[11px] font-semibold uppercase tracking-wide text-vago">{{ optional($item->published_at)->format('d/m/Y') }}</p>
                                <h4 class="mt-1 line-clamp-2 text-sm font-semibold text-vago-deep group-hover:text-vago">{{ $item->t('title') }}</h4>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
