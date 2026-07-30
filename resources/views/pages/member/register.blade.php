@extends('layouts.app')

@section('title', __('site.member_register_title').' — VAGO')
@section('description', 'Đăng ký hội viên Hội Phụ sản Việt Nam (VAGO).')

@section('content')
    @include('partials.page-hero', [
        'title' => __('site.member_register_title'),
        'subtitle' => null,
    ])

    @include('partials.breadcrumb', ['items' => [
        ['label' => __('site.nav_member'), 'url' => route('member.the-le')],
        ['label' => __('site.member_register_title')],
    ]])

    <div class="mx-auto max-w-3xl px-4 py-16 sm:px-6 lg:px-8">
        @if (session('member_success'))
            <div class="mb-8 rounded-md border border-vago/30 bg-vago/10 px-5 py-4 text-sm font-medium text-vago-dark">
                {{ session('member_success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-8 rounded-md border border-accent/30 bg-accent/5 px-5 py-4 text-sm text-accent">
                <ul class="list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('member.store') }}" method="post" enctype="multipart/form-data" class="space-y-6 rounded-md border border-vago/10 bg-white/70 p-6 sm:p-8">
            @csrf

            {{-- Honeypot: hidden from real users, bots tend to fill every field --}}
            <div class="hidden" aria-hidden="true">
                <label for="website">Website</label>
                <input type="text" id="website" name="website" tabindex="-1" autocomplete="off" value="{{ old('website') }}">
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="full_name" class="form-label">{{ __('site.member_field_full_name') }} <span class="text-accent">*</span></label>
                    <input id="full_name" name="full_name" type="text" required value="{{ old('full_name') }}" class="form-input">
                </div>

                <div>
                    <label for="date_of_birth" class="form-label">{{ __('site.member_field_dob') }}</label>
                    <input id="date_of_birth" name="date_of_birth" type="date" value="{{ old('date_of_birth') }}" class="form-input">
                </div>

                <div>
                    <label for="gender" class="form-label">{{ __('site.member_field_gender') }}</label>
                    <select id="gender" name="gender" class="form-input">
                        <option value="">—</option>
                        <option value="male" @selected(old('gender') === 'male')>{{ __('site.member_gender_male') }}</option>
                        <option value="female" @selected(old('gender') === 'female')>{{ __('site.member_gender_female') }}</option>
                        <option value="other" @selected(old('gender') === 'other')>{{ __('site.member_gender_other') }}</option>
                    </select>
                </div>

                <div>
                    <label for="academic_title" class="form-label">{{ __('site.member_field_academic_title') }}</label>
                    <input id="academic_title" name="academic_title" type="text" value="{{ old('academic_title') }}" class="form-input">
                </div>

                <div>
                    <label for="specialty" class="form-label">{{ __('site.member_field_specialty') }}</label>
                    <input id="specialty" name="specialty" type="text" value="{{ old('specialty') }}" class="form-input">
                </div>

                <div>
                    <label for="organization" class="form-label">{{ __('site.member_field_organization') }}</label>
                    <input id="organization" name="organization" type="text" value="{{ old('organization') }}" class="form-input">
                </div>

                <div>
                    <label for="job_title" class="form-label">{{ __('site.member_field_job_title') }}</label>
                    <input id="job_title" name="job_title" type="text" value="{{ old('job_title') }}" class="form-input">
                </div>

                <div>
                    <label for="phone" class="form-label">{{ __('site.member_field_phone') }}</label>
                    <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" class="form-input">
                </div>

                <div>
                    <label for="email" class="form-label">{{ __('site.member_field_email') }} <span class="text-accent">*</span></label>
                    <input id="email" name="email" type="email" required value="{{ old('email') }}" class="form-input">
                </div>

                <div class="sm:col-span-2">
                    <label for="address" class="form-label">{{ __('site.member_field_address') }}</label>
                    <input id="address" name="address" type="text" value="{{ old('address') }}" class="form-input">
                </div>

                <div>
                    <label for="province" class="form-label">{{ __('site.member_field_province') }}</label>
                    <input id="province" name="province" type="text" value="{{ old('province') }}" class="form-input">
                </div>

                <div>
                    <label for="member_type" class="form-label">{{ __('site.member_field_member_type') }}</label>
                    <input id="member_type" name="member_type" type="text" value="{{ old('member_type') }}" class="form-input">
                </div>

                <div class="sm:col-span-2">
                    <label for="attachment" class="form-label">{{ __('site.member_field_attachment') }}</label>
                    <input id="attachment" name="attachment" type="file" class="form-input file:mr-4 file:rounded file:border-0 file:bg-vago file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-white">
                </div>

                <div class="sm:col-span-2">
                    <label for="notes" class="form-label">{{ __('site.member_field_notes') }}</label>
                    <textarea id="notes" name="notes" rows="4" class="form-input">{{ old('notes') }}</textarea>
                </div>
            </div>

            <button type="submit" class="btn-primary w-full sm:w-auto">
                {{ __('site.member_submit') }}
            </button>
        </form>
    </div>
@endsection
