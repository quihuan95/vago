@php
    $officeEmail = \App\Models\Setting::getValue('contact_email', 'vago.vn@gmail.com');
    $officePhone = \App\Models\Setting::getValue('contact_phone', '024.9346743');
    $officeAddress = \App\Models\Setting::getValue(
        \App\Support\Locale::field('contact_address'),
        'Tầng 7, nhà G, Bệnh viện Phụ sản Trung ương, Số 1 Phố Triệu Quốc Đạt, Phường Cửa Nam, TP. Hà Nội'
    );
    $facebookUrl = \App\Models\Setting::getValue('facebook_url');
    $youtubeUrl = \App\Models\Setting::getValue('youtube_url');
    $logo = \App\Models\Setting::getValue('logo');
    $logoUrl = $logo ? asset('storage/'.$logo) : asset('images/logo.jpg');
@endphp

<footer class="mt-auto border-t border-vago/10 bg-vago-deep text-white">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-14 sm:px-6 md:grid-cols-3 lg:px-8">
        <div>
            <div class="flex items-center gap-3">
                <img src="{{ $logoUrl }}" alt="VAGO" class="h-12 w-12 rounded-full bg-white object-cover">
                <div>
                    <p class="font-display text-3xl font-semibold tracking-wide">VAGO</p>
                    <p class="text-xs uppercase tracking-[0.16em] text-white/70">{{ __('site.site_name') }}</p>
                </div>
            </div>
            <p class="mt-5 max-w-sm text-sm leading-relaxed text-white/75">
                Tổ chức xã hội – nghề nghiệp quy tụ giáo sư, bác sĩ và chuyên gia sản – phụ khoa trên toàn quốc.
            </p>

            @if ($facebookUrl || $youtubeUrl)
                <div class="mt-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.16em] text-white/60">{{ __('site.footer_follow') }}</p>
                    <div class="mt-3 flex gap-3">
                        @if ($facebookUrl)
                            <a href="{{ $facebookUrl }}" target="_blank" rel="noopener" aria-label="Facebook" class="flex h-9 w-9 items-center justify-center rounded-full bg-white/10 transition hover:bg-white/20">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12.06C22 6.5 17.52 2 12 2S2 6.5 2 12.06c0 5 3.66 9.15 8.44 9.94v-7.03H7.9v-2.9h2.54V9.85c0-2.5 1.49-3.89 3.78-3.89 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56v1.88h2.78l-.44 2.9h-2.34V22c4.78-.8 8.44-4.95 8.44-9.94z"/></svg>
                            </a>
                        @endif
                        @if ($youtubeUrl)
                            <a href="{{ $youtubeUrl }}" target="_blank" rel="noopener" aria-label="YouTube" class="flex h-9 w-9 items-center justify-center rounded-full bg-white/10 transition hover:bg-white/20">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M23.5 6.2a3 3 0 00-2.1-2.1C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.6A3 3 0 00.5 6.2 31.6 31.6 0 000 12a31.6 31.6 0 00.5 5.8 3 3 0 002.1 2.1c1.9.6 9.4.6 9.4.6s7.5 0 9.4-.6a3 3 0 002.1-2.1A31.6 31.6 0 0024 12a31.6 31.6 0 00-.5-5.8zM9.6 15.6V8.4l6.3 3.6-6.3 3.6z"/></svg>
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <div>
            <h2 class="font-display text-xl font-semibold">{{ __('site.footer_quick_links') }}</h2>
            <ul class="mt-4 space-y-2 text-sm text-white/80">
                <li><a class="hover:text-white" href="{{ route('about.gioi-thieu-chung') }}">{{ __('site.nav_about_general') }}</a></li>
                <li><a class="hover:text-white" href="{{ route('about.ban-chap-hanh') }}">{{ __('site.nav_about_board') }}</a></li>
                <li><a class="hover:text-white" href="{{ route('training.index') }}">{{ __('site.nav_training') }}</a></li>
                <li><a class="hover:text-white" href="{{ route('member.register') }}">{{ __('site.nav_member_register') }}</a></li>
                <li><a class="hover:text-white" href="{{ route('gallery.index') }}">{{ __('site.nav_gallery') }}</a></li>
                <li><a class="hover:text-white" href="{{ route('news.thong-bao') }}">{{ __('site.nav_news') }}</a></li>
                <li><a class="hover:text-white" href="{{ route('contact.show') }}">{{ __('site.nav_contact') }}</a></li>
            </ul>
        </div>

        <div>
            <h2 class="font-display text-xl font-semibold">{{ __('site.footer_office') }}</h2>
            <address class="mt-4 space-y-2 text-sm not-italic leading-relaxed text-white/80">
                <p>{{ $officeAddress }}</p>
                <p>Email: <a class="hover:text-white" href="mailto:{{ $officeEmail }}">{{ $officeEmail }}</a></p>
                <p>{{ __('site.contact_field_phone') }}: <a class="hover:text-white" href="tel:{{ preg_replace('/[^0-9+]/', '', $officePhone) }}">{{ $officePhone }}</a></p>
            </address>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="mx-auto flex max-w-7xl flex-col gap-2 px-4 py-5 text-xs text-white/55 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <p>&copy; {{ date('Y') }} {{ __('site.footer_copyright') }}</p>
            <p>{{ __('site.footer_english_name') }}</p>
        </div>
    </div>
</footer>
