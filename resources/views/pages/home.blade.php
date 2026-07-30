@extends('layouts.app')

@section('title', __('site.site_name').' (VAGO)')
@section('description', 'Hội Phụ sản Việt Nam (VAGO) — Vietnam Association of Gynecology and Obstetrics.')

@section('content')

    {{-- ============ Khối 1: Banner / slider ============ --}}
    @if ($banners->isNotEmpty())
        <section class="relative min-h-[70vh] overflow-hidden bg-vago-deep sm:min-h-[88vh]" data-slider data-slider-interval="6000">
            <div class="slider-track relative h-[70vh] sm:h-[88vh]">
                @foreach ($banners as $index => $banner)
                    <div
                        class="slider-slide absolute inset-0 transition-opacity duration-700 {{ $loop->first ? 'opacity-100' : 'opacity-0 pointer-events-none' }}"
                        data-slide-index="{{ $index }}"
                    >
                        @php
                            $desktopSrc = str_starts_with($banner->image_desktop, 'images/')
                                ? asset($banner->image_desktop)
                                : asset('storage/'.$banner->image_desktop);
                            $mobileSrc = $banner->image_mobile
                                ? (str_starts_with($banner->image_mobile, 'images/')
                                    ? asset($banner->image_mobile)
                                    : asset('storage/'.$banner->image_mobile))
                                : null;
                        @endphp
                        <picture>
                            @if ($mobileSrc)
                                <source media="(max-width: 640px)" srcset="{{ $mobileSrc }}">
                            @endif
                            <img
                                src="{{ $desktopSrc }}"
                                alt="{{ $banner->t('title') ?: 'VAGO' }}"
                                class="h-full w-full object-cover object-center"
                                loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                            >
                        </picture>

                        @if ($banner->t('title') || $banner->t('description'))
                            <div class="relative z-10 mx-auto flex h-full max-w-7xl flex-col justify-end px-4 pb-16 sm:px-6 lg:px-8 lg:pb-24">
                                <div class="max-w-2xl">
                                    @if ($banner->t('title'))
                                        <h2 class="font-display text-3xl font-semibold text-white sm:text-5xl">{{ $banner->t('title') }}</h2>
                                    @endif
                                    @if ($banner->t('description'))
                                        <p class="mt-4 max-w-xl text-base text-white/85 sm:text-lg">{{ $banner->t('description') }}</p>
                                    @endif
                                    @if ($banner->link_url)
                                        <a
                                            href="{{ $banner->link_url }}"
                                            @if ($banner->open_in_new_tab) target="_blank" rel="noopener" @endif
                                            class="btn-primary mt-6"
                                        >
                                            {{ __('site.read_more') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            @if ($banners->count() > 1)
                <button type="button" data-slider-prev aria-label="Previous slide" class="absolute left-3 top-1/2 z-20 -translate-y-1/2 rounded-full bg-white/20 p-2 text-white transition hover:bg-white/40 sm:left-6">
                    <svg class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 010 1.06L8.06 11l4.73 4.71a.75.75 0 11-1.06 1.06l-5.25-5.25a.75.75 0 010-1.06l5.25-5.25a.75.75 0 011.06 0z" clip-rule="evenodd"/></svg>
                </button>
                <button type="button" data-slider-next aria-label="Next slide" class="absolute right-3 top-1/2 z-20 -translate-y-1/2 rounded-full bg-white/20 p-2 text-white transition hover:bg-white/40 sm:right-6">
                    <svg class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 010-1.06L11.94 9 7.21 4.29a.75.75 0 111.06-1.06l5.25 5.25a.75.75 0 010 1.06l-5.25 5.25a.75.75 0 01-1.06 0z" clip-rule="evenodd"/></svg>
                </button>
                <div class="absolute bottom-4 left-1/2 z-20 flex -translate-x-1/2 gap-2" data-slider-dots>
                    @foreach ($banners as $index => $banner)
                        <button
                            type="button"
                            data-slider-dot="{{ $index }}"
                            aria-label="Slide {{ $index + 1 }}"
                            class="h-2.5 w-2.5 rounded-full transition {{ $loop->first ? 'bg-white' : 'bg-white/40' }}"
                        ></button>
                    @endforeach
                </div>
            @endif
        </section>
    @else
        <section class="relative min-h-[70vh] overflow-hidden bg-vago-deep sm:min-h-[88vh]">
            <img
                src="{{ asset('images/hero-banner.jpg') }}"
                alt="VAGO — Hội Phụ sản Việt Nam"
                class="animate-soft-zoom absolute inset-0 h-full w-full object-cover object-center"
            >
            <div class="absolute inset-0 bg-gradient-to-r from-vago-deep/95 via-vago-deep/70 to-vago-deep/25"></div>
            <div class="relative mx-auto flex min-h-[70vh] max-w-7xl flex-col justify-end px-4 pb-16 pt-24 sm:px-6 sm:min-h-[88vh] sm:pb-20 lg:px-8 lg:pb-24">
                <div class="max-w-3xl">
                    <p class="animate-fade-up font-display text-5xl font-semibold tracking-wide text-white sm:text-6xl lg:text-7xl">VAGO</p>
                    <p class="animate-fade-up-delay mt-2 text-sm font-medium uppercase tracking-[0.2em] text-white/80">{{ __('site.site_name') }}</p>
                    <h1 class="animate-fade-up-delay mt-8 max-w-2xl font-display text-3xl font-medium leading-tight text-white sm:text-4xl lg:text-[2.75rem]">
                        Kết nối chuyên môn, nâng cao chăm sóc sức khỏe bà mẹ và trẻ sơ sinh
                    </h1>
                    <div class="animate-fade-up-delay-2 mt-9 flex flex-wrap gap-3">
                        <a href="{{ route('about.gioi-thieu-chung') }}" class="btn-primary bg-white text-vago-deep hover:bg-sand">{{ __('site.read_more') }}</a>
                        <a href="{{ route('contact.show') }}" class="btn-outline border-white/40 text-white hover:bg-white/10">{{ __('site.nav_contact') }}</a>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- ============ Khối 2: Tin tức nổi bật ============ --}}
    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="section-eyebrow">{{ __('site.nav_news') }}</p>
                <h2 class="section-title">{{ __('site.home_featured_news') }}</h2>
                <p class="mt-4 max-w-2xl text-muted">{{ __('site.home_featured_news_desc') }}</p>
            </div>
            <a href="{{ route('news.thong-bao') }}" class="btn-outline">{{ __('site.home_view_all_news') }}</a>
        </div>

        @if ($featuredPosts->isEmpty())
            <p class="mt-12 text-muted">{{ __('site.no_posts') }} {{ __('site.updating') }}</p>
        @else
            <div class="mt-10 grid gap-6 lg:grid-cols-3">
                @php $main = $featuredPosts->first(); @endphp
                <a href="{{ route('news.show', $main->localizedSlug() ?: $main->slug_vi) }}" class="card group lg:col-span-2">
                    <div class="aspect-[16/9] overflow-hidden bg-vago/10">
                        @if ($main->featured_image)
                            <img src="{{ asset('storage/'.$main->featured_image) }}" alt="{{ $main->t('title') }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                        @endif
                    </div>
                    <div class="p-6">
                        <p class="text-xs font-semibold uppercase tracking-wide text-vago">{{ optional($main->published_at)->format('d/m/Y') }}</p>
                        <h3 class="mt-2 font-display text-2xl font-semibold text-vago-deep group-hover:text-vago">{{ $main->t('title') }}</h3>
                        <p class="mt-3 text-sm leading-relaxed text-muted">{{ \Illuminate\Support\Str::limit($main->t('excerpt'), 160) }}</p>
                    </div>
                </a>

                <div class="flex flex-col gap-5">
                    @foreach ($featuredPosts->skip(1)->take(3) as $post)
                        <a href="{{ route('news.show', $post->localizedSlug() ?: $post->slug_vi) }}" class="card group flex gap-4 p-3">
                            <div class="h-20 w-24 shrink-0 overflow-hidden rounded-sm bg-vago/10">
                                @if ($post->featured_image)
                                    <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->t('title') }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                                @endif
                            </div>
                            <div class="min-w-0">
                                <p class="text-[11px] font-semibold uppercase tracking-wide text-vago">{{ optional($post->published_at)->format('d/m/Y') }}</p>
                                <h4 class="mt-1 line-clamp-2 text-sm font-semibold text-vago-deep group-hover:text-vago">{{ $post->t('title') }}</h4>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </section>

    {{-- ============ Khối 3: Thông báo của Hội ============ --}}
    <section class="bg-white/60">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div>
                    <p class="section-eyebrow">{{ __('site.nav_news_announcement') }}</p>
                    <h2 class="section-title">{{ __('site.home_announcements') }}</h2>
                    <p class="mt-4 max-w-2xl text-muted">{{ __('site.home_announcements_desc') }}</p>
                </div>
                <a href="{{ route('news.thong-bao') }}" class="btn-outline">{{ __('site.home_view_all_announcements') }}</a>
            </div>

            @if ($announcements->isEmpty())
                <p class="mt-12 text-muted">{{ __('site.updating') }}</p>
            @else
                <ul class="mt-10 divide-y divide-vago/10 border-y border-vago/10">
                    @foreach ($announcements as $announcement)
                        <li>
                            <a href="{{ route('news.show', $announcement->localizedSlug() ?: $announcement->slug_vi) }}" class="flex flex-col gap-2 py-5 transition hover:bg-vago/5 sm:flex-row sm:items-center sm:justify-between sm:px-4">
                                <div class="min-w-0">
                                    <h3 class="font-display text-lg font-semibold text-vago-deep">{{ $announcement->t('title') }}</h3>
                                    <p class="mt-1 truncate text-sm text-muted">{{ $announcement->t('excerpt') }}</p>
                                </div>
                                <span class="shrink-0 text-xs font-medium uppercase tracking-wide text-muted">{{ optional($announcement->published_at)->format('d/m/Y') }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </section>

    {{-- ============ Khối 4: Hội nghị VAGO 2026 ============ --}}
    <section class="relative overflow-hidden border-y border-vago/10 bg-vago text-white">
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 15% 20%, #ffffff 0%, transparent 40%);"></div>
        <div class="relative mx-auto flex max-w-7xl flex-col items-start justify-between gap-8 px-4 py-16 sm:px-6 lg:flex-row lg:items-center lg:px-8">
            <div class="max-w-2xl">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-white/70">VAGO 2026</p>
                <h2 class="mt-3 font-display text-3xl font-semibold sm:text-4xl">{{ __('site.home_vago2026_title') }}</h2>
                <p class="mt-4 text-white/85">{{ __('site.home_vago2026_desc') }}</p>
            </div>
            <a href="{{ $vago2026Url }}" target="_blank" rel="noopener" class="btn-primary shrink-0 bg-white text-vago-deep hover:bg-sand">
                {{ __('site.home_vago2026_cta') }}
            </a>
        </div>
    </section>
@endsection
