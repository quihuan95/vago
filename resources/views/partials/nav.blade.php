@php
    $aboutRoutes = ['about.gioi-thieu-chung', 'about.thu-chu-tich', 'about.ban-chap-hanh'];
    $memberRoutes = ['member.the-le', 'member.register', 'member.store'];
    $newsRoutes = ['news.thong-bao', 'news.hoat-dong', 'news.show'];
    $logo = \App\Models\Setting::getValue('logo');
    $logoUrl = $logo ? asset('storage/'.$logo) : asset('images/logo.jpg');
@endphp

<header class="sticky top-0 z-50 border-b border-vago/10 bg-sand/95 backdrop-blur-md">
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
        <a href="{{ route('home') }}" class="group flex shrink-0 items-center gap-3">
            <img
                src="{{ $logoUrl }}"
                alt="VAGO — Hội Phụ sản Việt Nam"
                class="h-12 w-12 rounded-full object-cover ring-2 ring-vago/20 transition group-hover:ring-vago/50"
            >
        </a>

        <nav class="hidden items-center gap-0.5 lg:flex" aria-label="Main navigation">
            <div class="group relative">
                <button type="button" @class(['nav-link inline-flex items-center gap-1', 'nav-link--active' => request()->routeIs($aboutRoutes)])>
                    {{ __('site.nav_about') }}
                    <svg class="h-3.5 w-3.5 transition group-hover:rotate-180" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
                </button>
                <div class="invisible absolute left-0 top-full w-64 translate-y-1 rounded-md border border-vago/10 bg-white opacity-0 shadow-lg transition duration-150 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100">
                    <a href="{{ route('about.gioi-thieu-chung') }}" class="dropdown-link">{{ __('site.nav_about_general') }}</a>
                    <a href="{{ route('about.thu-chu-tich') }}" class="dropdown-link">{{ __('site.nav_about_president_letter') }}</a>
                    <a href="{{ route('about.ban-chap-hanh') }}" class="dropdown-link">{{ __('site.nav_about_board') }}</a>
                </div>
            </div>

            <a href="{{ $vago2026Url }}" target="_blank" rel="noopener" class="nav-link">
                {{ __('site.nav_vago2026') }}
            </a>

            <a href="{{ route('training.index') }}" @class(['nav-link', 'nav-link--active' => request()->routeIs('training.*')])>
                {{ __('site.nav_training') }}
            </a>

            <div class="group relative">
                <button type="button" @class(['nav-link inline-flex items-center gap-1', 'nav-link--active' => request()->routeIs($memberRoutes)])>
                    {{ __('site.nav_member') }}
                    <svg class="h-3.5 w-3.5 transition group-hover:rotate-180" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
                </button>
                <div class="invisible absolute left-0 top-full w-64 translate-y-1 rounded-md border border-vago/10 bg-white opacity-0 shadow-lg transition duration-150 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100">
                    <a href="{{ route('member.the-le') }}" class="dropdown-link">{{ __('site.nav_member_rules') }}</a>
                    <a href="{{ route('member.register') }}" class="dropdown-link">{{ __('site.nav_member_register') }}</a>
                </div>
            </div>

            <a href="{{ $journalUrl }}" target="_blank" rel="noopener" class="nav-link">
                {{ __('site.nav_journal') }}
            </a>

            <a href="{{ route('gallery.index') }}" @class(['nav-link', 'nav-link--active' => request()->routeIs('gallery.*')])>
                {{ __('site.nav_gallery') }}
            </a>

            <div class="group relative">
                <button type="button" @class(['nav-link inline-flex items-center gap-1', 'nav-link--active' => request()->routeIs($newsRoutes)])>
                    {{ __('site.nav_news') }}
                    <svg class="h-3.5 w-3.5 transition group-hover:rotate-180" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
                </button>
                <div class="invisible absolute left-0 top-full w-56 translate-y-1 rounded-md border border-vago/10 bg-white opacity-0 shadow-lg transition duration-150 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100">
                    <a href="{{ route('news.thong-bao') }}" class="dropdown-link">{{ __('site.nav_news_announcement') }}</a>
                    <a href="{{ route('news.hoat-dong') }}" class="dropdown-link">{{ __('site.nav_news_activity') }}</a>
                </div>
            </div>

            <a href="{{ route('contact.show') }}" @class(['nav-link', 'nav-link--active' => request()->routeIs('contact.*')])>
                {{ __('site.nav_contact') }}
            </a>
        </nav>

        <button
            id="nav-toggle"
            type="button"
            class="inline-flex items-center justify-center rounded-md border border-vago/20 p-2 text-vago-dark lg:hidden"
            aria-label="Menu"
            aria-expanded="false"
            aria-controls="mobile-nav"
        >
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </div>

    {{-- Mobile drawer --}}
    <div id="mobile-nav" class="hidden border-t border-vago/10 bg-sand lg:hidden">
        <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6">
            <nav class="flex flex-col divide-y divide-vago/10" aria-label="Mobile navigation">
                <a href="{{ route('home') }}" class="mobile-link">{{ __('site.nav_home') }}</a>

                <details @if(request()->routeIs($aboutRoutes)) open @endif>
                    <summary class="mobile-link cursor-pointer">{{ __('site.nav_about') }}</summary>
                    <div class="flex flex-col pb-2 pl-4">
                        <a href="{{ route('about.gioi-thieu-chung') }}" class="mobile-sublink">{{ __('site.nav_about_general') }}</a>
                        <a href="{{ route('about.thu-chu-tich') }}" class="mobile-sublink">{{ __('site.nav_about_president_letter') }}</a>
                        <a href="{{ route('about.ban-chap-hanh') }}" class="mobile-sublink">{{ __('site.nav_about_board') }}</a>
                    </div>
                </details>

                <a href="{{ $vago2026Url }}" target="_blank" rel="noopener" class="mobile-link">{{ __('site.nav_vago2026') }}</a>
                <a href="{{ route('training.index') }}" class="mobile-link">{{ __('site.nav_training') }}</a>

                <details @if(request()->routeIs($memberRoutes)) open @endif>
                    <summary class="mobile-link cursor-pointer">{{ __('site.nav_member') }}</summary>
                    <div class="flex flex-col pb-2 pl-4">
                        <a href="{{ route('member.the-le') }}" class="mobile-sublink">{{ __('site.nav_member_rules') }}</a>
                        <a href="{{ route('member.register') }}" class="mobile-sublink">{{ __('site.nav_member_register') }}</a>
                    </div>
                </details>

                <a href="{{ $journalUrl }}" target="_blank" rel="noopener" class="mobile-link">{{ __('site.nav_journal') }}</a>
                <a href="{{ route('gallery.index') }}" class="mobile-link">{{ __('site.nav_gallery') }}</a>

                <details @if(request()->routeIs($newsRoutes)) open @endif>
                    <summary class="mobile-link cursor-pointer">{{ __('site.nav_news') }}</summary>
                    <div class="flex flex-col pb-2 pl-4">
                        <a href="{{ route('news.thong-bao') }}" class="mobile-sublink">{{ __('site.nav_news_announcement') }}</a>
                        <a href="{{ route('news.hoat-dong') }}" class="mobile-sublink">{{ __('site.nav_news_activity') }}</a>
                    </div>
                </details>

                <a href="{{ route('contact.show') }}" class="mobile-link">{{ __('site.nav_contact') }}</a>
            </nav>
        </div>
    </div>
</header>
