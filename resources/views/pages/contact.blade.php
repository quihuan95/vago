@extends('layouts.app')

@section('title', __('site.contact_title').' — VAGO')
@section('description', __('site.contact_office_title').' — Hội Phụ sản Việt Nam (VAGO).')

@section('content')
    @php
        $officeEmail = \App\Models\Setting::getValue('contact_email', 'vago.vn@gmail.com');
        $officePhone = \App\Models\Setting::getValue('contact_phone', '024.9346743');
        $officeAddress = \App\Models\Setting::getValue(
            \App\Support\Locale::field('contact_address'),
            "Tầng 7, nhà G — Bệnh viện Phụ sản Trung ương\nSố 1 Phố Triệu Quốc Đạt, Phường Cửa Nam, TP. Hà Nội"
        );
        $mapEmbedUrl = \App\Models\Setting::getValue('google_maps_embed');
    @endphp

    @include('partials.page-hero', [
        'title' => __('site.contact_title'),
        'subtitle' => __('site.contact_office_title'),
    ])

    @include('partials.breadcrumb', ['items' => [
        ['label' => __('site.contact_title')],
    ]])

    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-2">
            <div>
                <h2 class="font-display text-3xl font-semibold text-vago-deep">{{ __('site.contact_office_title') }}</h2>
                <div class="mt-4 h-1 w-20 bg-accent-warm"></div>

                <dl class="mt-10 space-y-8">
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-[0.16em] text-vago">{{ __('site.contact_field_address') }}</dt>
                        <dd class="mt-2 leading-relaxed text-muted">{!! nl2br(e($officeAddress)) !!}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-[0.16em] text-vago">Email</dt>
                        <dd class="mt-2">
                            <a href="mailto:{{ $officeEmail }}" class="font-medium text-vago-dark hover:text-vago">{{ $officeEmail }}</a>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-[0.16em] text-vago">{{ __('site.contact_field_phone') }}</dt>
                        <dd class="mt-2">
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $officePhone) }}" class="font-medium text-vago-dark hover:text-vago">{{ $officePhone }}</a>
                        </dd>
                    </div>
                </dl>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $officePhone) }}" class="btn-outline">{{ __('site.contact_field_phone') }}</a>
                    <a href="mailto:{{ $officeEmail }}" class="btn-outline">Email</a>
                </div>

                @if ($mapEmbedUrl)
                    <div class="mt-10 aspect-video overflow-hidden rounded-md border border-vago/10">
                        <iframe src="{{ $mapEmbedUrl }}" class="h-full w-full" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Google Maps"></iframe>
                    </div>
                @endif
            </div>

            <div class="bg-white/70 p-8 sm:p-10">
                <h2 class="font-display text-2xl font-semibold text-vago-deep">{{ __('site.contact_submit') }}</h2>

                @if (session('contact_success'))
                    <div class="mt-6 rounded-md border border-vago/30 bg-vago/10 px-5 py-4 text-sm font-medium text-vago-dark">
                        {{ session('contact_success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mt-6 rounded-md border border-accent/30 bg-accent/5 px-5 py-4 text-sm text-accent">
                        <ul class="list-disc space-y-1 pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="post" class="mt-8 space-y-5">
                    @csrf

                    {{-- Honeypot: hidden from real users, bots tend to fill every field --}}
                    <div class="hidden" aria-hidden="true">
                        <label for="website">Website</label>
                        <input type="text" id="website" name="website" tabindex="-1" autocomplete="off" value="{{ old('website') }}">
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="full_name" class="form-label">{{ __('site.contact_field_full_name') }} <span class="text-accent">*</span></label>
                            <input id="full_name" name="full_name" type="text" required value="{{ old('full_name') }}" class="form-input">
                        </div>
                        <div>
                            <label for="phone" class="form-label">{{ __('site.contact_field_phone') }}</label>
                            <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" class="form-input">
                        </div>
                    </div>

                    <div>
                        <label for="address" class="form-label">{{ __('site.contact_field_address') }}</label>
                        <input id="address" name="address" type="text" value="{{ old('address') }}" class="form-input">
                    </div>

                    <div>
                        <label for="email" class="form-label">{{ __('site.contact_field_email') }} <span class="text-accent">*</span></label>
                        <input id="email" name="email" type="email" required value="{{ old('email') }}" class="form-input">
                    </div>

                    <div>
                        <label for="subject" class="form-label">{{ __('site.contact_field_subject') }}</label>
                        <input id="subject" name="subject" type="text" value="{{ old('subject') }}" class="form-input">
                    </div>

                    <div>
                        <label for="message" class="form-label">{{ __('site.contact_field_message') }} <span class="text-accent">*</span></label>
                        <textarea id="message" name="message" rows="5" required class="form-input">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="btn-primary w-full sm:w-auto">
                        {{ __('site.contact_submit') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
