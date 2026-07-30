@extends('layouts.app')

@section('title', $heading.' — '.__('site.news_title'))
@section('description', __('site.news_title').' — Hội Phụ sản Việt Nam (VAGO).')

@section('content')
    @include('partials.page-hero', [
        'title' => __('site.news_title'),
        'subtitle' => null,
    ])

    @include('partials.breadcrumb', ['items' => [
        ['label' => __('site.news_title'), 'url' => route('news.thong-bao')],
        ['label' => $heading],
    ]])

    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="mb-10 flex gap-2 border-b border-vago/10">
            <a
                href="{{ route('news.thong-bao') }}"
                @class([
                    'border-b-2 px-4 py-3 text-sm font-semibold transition',
                    'border-vago text-vago-dark' => $activeSlug === 'thong-bao',
                    'border-transparent text-muted hover:text-vago-dark' => $activeSlug !== 'thong-bao',
                ])
            >
                {{ __('site.nav_news_announcement') }}
            </a>
            <a
                href="{{ route('news.hoat-dong') }}"
                @class([
                    'border-b-2 px-4 py-3 text-sm font-semibold transition',
                    'border-vago text-vago-dark' => $activeSlug === 'hoat-dong',
                    'border-transparent text-muted hover:text-vago-dark' => $activeSlug !== 'hoat-dong',
                ])
            >
                {{ __('site.nav_news_activity') }}
            </a>
        </div>

        @if ($posts->isEmpty())
            <div class="rounded-md border border-dashed border-vago/30 bg-white/60 px-8 py-16 text-center">
                <p class="font-display text-xl font-semibold text-vago-deep">{{ __('site.updating') }}</p>
                <p class="mt-3 text-sm text-muted">{{ __('site.no_posts') }}</p>
            </div>
        @else
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($posts as $post)
                    <a href="{{ route('news.show', $post->localizedSlug() ?: $post->slug_vi) }}" class="card group flex flex-col">
                        <div class="aspect-[16/10] overflow-hidden bg-vago/10">
                            @if ($post->featured_image)
                                <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->t('title') }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                            @endif
                        </div>
                        <div class="flex flex-1 flex-col p-5">
                            <p class="text-xs font-semibold uppercase tracking-wide text-vago">{{ optional($post->published_at)->format('d/m/Y') }}</p>
                            <h3 class="mt-2 font-display text-lg font-semibold text-vago-deep group-hover:text-vago">{{ $post->t('title') }}</h3>
                            <p class="mt-3 flex-1 text-sm leading-relaxed text-muted">{{ \Illuminate\Support\Str::limit($post->t('excerpt'), 110) }}</p>
                            <span class="mt-4 text-sm font-semibold text-vago">{{ __('site.read_more') }} →</span>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection
