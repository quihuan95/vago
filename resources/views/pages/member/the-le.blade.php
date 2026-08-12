@extends('layouts.app')

@section('title', $page?->t('seo_title') ?: $page?->t('title') ?: __('site.member_rules_title'))
@section('description', $page?->t('seo_description') ?: $page?->t('excerpt') ?: __('site.member_rules_intro'))

@section('content')
    @include('partials.page-hero', [
        'title' => $page?->t('title') ?: __('site.member_rules_title'),
        'subtitle' => $page?->t('excerpt') ?: __('site.member_rules_intro'),
    ])

    @include('partials.breadcrumb', ['items' => [
        ['label' => __('site.nav_member'), 'url' => route('member.the-le')],
        ['label' => __('site.member_rules_title')],
    ]])

    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        @if ($page && $page->t('content'))
            <div class="rich-content max-w-none">
                {!! $page->t('content') !!}
            </div>
        @else
            <p class="text-muted">{{ __('site.member_rules_intro') }}</p>
        @endif

        <div class="mt-8 overflow-hidden rounded-md border border-vago/15 bg-white shadow-sm">
            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-vago/10 px-4 py-3 sm:px-5">
                <p class="text-sm font-medium text-vago-deep">{{ __('site.member_rules_document') }}</p>
                <a href="{{ $pdfUrl }}" target="_blank" rel="noopener" class="btn-outline inline-flex text-sm">
                    {{ __('site.member_rules_download') }}
                </a>
            </div>
            <iframe
                src="{{ $pdfUrl }}#view=FitH"
                title="{{ __('site.member_rules_document') }}"
                class="h-[80vh] w-full bg-surface"
            ></iframe>
        </div>

        <div class="mt-10 text-center">
            <a href="{{ route('member.register') }}" class="btn-primary">{{ __('site.member_register_cta') }}</a>
        </div>
    </div>
@endsection
