@extends('layouts.app')

@section('title', __('site.nav_about_board').' — VAGO')
@section('description', __('site.board_title').' — Hội Phụ sản Việt Nam (VAGO).')

@section('content')
    @include('partials.page-hero', [
        'title' => __('site.nav_about_board'),
        'subtitle' => null,
    ])

    @include('partials.breadcrumb', ['items' => [
        ['label' => __('site.nav_about'), 'url' => route('about.gioi-thieu-chung')],
        ['label' => __('site.nav_about_board')],
    ]])

    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        @if ($members->isEmpty())
            <div class="rounded-md border border-dashed border-vago/30 bg-white/60 px-8 py-16 text-center">
                <p class="font-display text-xl font-semibold text-vago-deep">{{ __('site.updating') }}</p>
                <p class="mt-3 text-sm text-muted">Danh sách Ban Chấp hành sẽ được cập nhật trong thời gian tới.</p>
            </div>
        @else
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($members as $member)
                    <article class="card">
                        <div class="aspect-square overflow-hidden bg-vago/10">
                            @if ($member->photo)
                                <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->t('name') }}" class="h-full w-full object-cover" loading="lazy">
                            @else
                                <div class="flex h-full w-full items-center justify-center text-4xl font-display text-vago/30">
                                    {{ mb_substr($member->t('name'), 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div class="p-5">
                            <h3 class="font-display text-lg font-semibold text-vago-deep">{{ $member->t('name') }}</h3>
                            @if ($member->t('position'))
                                <p class="mt-1 text-sm font-medium text-vago">{{ $member->t('position') }}</p>
                            @endif
                            @if ($member->t('title'))
                                <p class="mt-1 text-xs text-muted">{{ $member->t('title') }}</p>
                            @endif
                            @if ($member->t('organization'))
                                <p class="mt-1 text-xs text-muted">{{ $member->t('organization') }}</p>
                            @endif
                            @if ($member->term)
                                <p class="mt-3 text-[11px] font-semibold uppercase tracking-wide text-muted">{{ __('site.board_term') }}: {{ $member->term }}</p>
                            @endif
                            @if ($member->t('bio'))
                                <p class="mt-3 text-sm leading-relaxed text-muted">{{ \Illuminate\Support\Str::limit($member->t('bio'), 140) }}</p>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
@endsection
