@extends('layouts.app')

@section('title', $page?->t('seo_title') ?: $page?->t('title') ?: __('site.nav_about_president_letter'))
@section('description', $page?->t('seo_description') ?: $page?->t('excerpt') ?: __('site.updating'))

@section('content')
    @include('partials.page-hero', [
        'title' => $page?->t('title') ?: __('site.nav_about_president_letter'),
        'subtitle' => $page?->t('excerpt'),
    ])

    @include('partials.breadcrumb', ['items' => [
        ['label' => __('site.nav_about'), 'url' => route('about.gioi-thieu-chung')],
        ['label' => __('site.nav_about_president_letter')],
    ]])

    <div class="mx-auto max-w-4xl px-4 py-16 sm:px-6 lg:px-8">
        @if ($page && $page->t('content'))
            <div class="grid gap-10 sm:grid-cols-[220px_1fr]">
                @if ($page->featured_image)
                    <figure class="mx-auto sm:mx-0">
                        <img src="{{ asset('storage/'.$page->featured_image) }}" alt="{{ $page->t('title') }}" class="aspect-[3/4] w-48 rounded-md object-cover shadow-sm sm:w-full">
                    </figure>
                @endif
                <div class="rich-content max-w-none">
                    {!! $page->t('content') !!}
                </div>
            </div>
        @else
            <div class="rounded-md border border-dashed border-vago/30 bg-white/60 px-8 py-16 text-center">
                <p class="font-display text-xl font-semibold text-vago-deep">{{ __('site.updating') }}</p>
                <p class="mt-3 text-sm text-muted">Nội dung thư của Chủ tịch Hội sẽ được cập nhật trong thời gian tới.</p>
            </div>
        @endif
    </div>
@endsection
