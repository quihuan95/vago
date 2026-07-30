@extends('layouts.app')

@section('title', $page?->t('seo_title') ?: $page?->t('title') ?: __('site.member_rules_title'))
@section('description', $page?->t('seo_description') ?: $page?->t('excerpt') ?: __('site.updating'))

@section('content')
    @include('partials.page-hero', [
        'title' => $page?->t('title') ?: __('site.member_rules_title'),
        'subtitle' => $page?->t('excerpt'),
    ])

    @include('partials.breadcrumb', ['items' => [
        ['label' => __('site.nav_member'), 'url' => route('member.the-le')],
        ['label' => __('site.member_rules_title')],
    ]])

    <div class="mx-auto max-w-4xl px-4 py-16 sm:px-6 lg:px-8">
        @if ($page && $page->t('content'))
            <div class="rich-content max-w-none">
                {!! $page->t('content') !!}
            </div>

            @if ($page->featured_image)
                <a href="{{ asset('storage/'.$page->featured_image) }}" target="_blank" class="btn-outline mt-6 inline-flex">
                    {{ __('site.download_attachment') }}
                </a>
            @endif
        @else
            <div class="rounded-md border border-dashed border-vago/30 bg-white/60 px-8 py-16 text-center">
                <p class="font-display text-xl font-semibold text-vago-deep">{{ __('site.updating') }}</p>
                <p class="mt-3 text-sm text-muted">Thể lệ đăng ký hội viên sẽ được cập nhật trong thời gian tới.</p>
            </div>
        @endif

        <div class="mt-10 text-center">
            <a href="{{ route('member.register') }}" class="btn-primary">{{ __('site.member_register_cta') }}</a>
        </div>
    </div>
@endsection
