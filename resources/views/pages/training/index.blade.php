@extends('layouts.app')

@section('title', __('site.training_title').' — VAGO')
@section('description', 'Các chương trình đào tạo, hội thảo khoa học của Hội Phụ sản Việt Nam (VAGO).')

@section('content')
    @include('partials.page-hero', [
        'title' => __('site.training_title'),
        'subtitle' => null,
    ])

    @include('partials.breadcrumb', ['items' => [
        ['label' => __('site.training_title')],
    ]])

    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        @if ($programs->isEmpty())
            <div class="rounded-md border border-dashed border-vago/30 bg-white/60 px-8 py-16 text-center">
                <p class="font-display text-xl font-semibold text-vago-deep">{{ __('site.updating') }}</p>
                <p class="mt-3 text-sm text-muted">{{ __('site.no_programs') }}</p>
            </div>
        @else
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($programs as $program)
                    <a href="{{ route('training.show', $program->localizedSlug() ?: $program->slug_vi) }}" class="card group flex flex-col">
                        <div class="aspect-[16/10] overflow-hidden bg-vago/10">
                            @if ($program->featured_image)
                                <img src="{{ asset('storage/'.$program->featured_image) }}" alt="{{ $program->t('title') }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                            @endif
                        </div>
                        <div class="flex flex-1 flex-col p-5">
                            @if ($program->program_status)
                                <span class="mb-2 inline-flex w-fit rounded-full bg-vago/10 px-3 py-1 text-[11px] font-semibold uppercase tracking-wide text-vago-dark">
                                    {{ __('site.training_status_'.$program->program_status) }}
                                </span>
                            @endif
                            <h3 class="font-display text-lg font-semibold text-vago-deep group-hover:text-vago">{{ $program->t('title') }}</h3>
                            <p class="mt-2 flex-1 text-sm leading-relaxed text-muted">{{ \Illuminate\Support\Str::limit($program->t('excerpt'), 120) }}</p>
                            @if ($program->starts_at)
                                <p class="mt-4 text-xs font-medium uppercase tracking-wide text-muted">{{ $program->starts_at->format('d/m/Y') }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $programs->links() }}
            </div>
        @endif
    </div>
@endsection
