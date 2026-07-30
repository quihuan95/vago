@extends('layouts.app')

@section('title', $program->t('seo_title') ?: $program->t('title'))
@section('description', $program->t('seo_description') ?: $program->t('excerpt') ?: __('site.updating'))

@section('content')
    @include('partials.page-hero', [
        'title' => $program->t('title'),
        'subtitle' => $program->t('excerpt'),
    ])

    @include('partials.breadcrumb', ['items' => [
        ['label' => __('site.training_title'), 'url' => route('training.index')],
        ['label' => $program->t('title')],
    ]])

    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-[1fr_320px]">
            <div>
                @if ($program->featured_image)
                    <img src="{{ asset('storage/'.$program->featured_image) }}" alt="{{ $program->t('title') }}" class="mb-8 aspect-[16/9] w-full rounded-md object-cover">
                @endif

                @if ($program->t('content'))
                    <div class="rich-content max-w-none">
                        {!! $program->t('content') !!}
                    </div>
                @else
                    <p class="text-muted">{{ __('site.updating') }}</p>
                @endif

                @if ($program->attachment)
                    <a href="{{ asset('storage/'.$program->attachment) }}" target="_blank" class="btn-outline mt-8 inline-flex">
                        {{ __('site.download_attachment') }}
                    </a>
                @endif
            </div>

            <aside class="h-fit rounded-md border border-vago/10 bg-white/70 p-6">
                <h2 class="font-display text-lg font-semibold text-vago-deep">{{ __('site.training_title') }}</h2>
                <dl class="mt-4 space-y-4 text-sm">
                    @if ($program->program_status)
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wide text-muted">{{ __('site.training_title') }}</dt>
                            <dd class="mt-1 font-medium text-vago-dark">{{ __('site.training_status_'.$program->program_status) }}</dd>
                        </div>
                    @endif
                    @if ($program->starts_at)
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wide text-muted">{{ __('site.training_time') }}</dt>
                            <dd class="mt-1">
                                {{ $program->starts_at->format('d/m/Y') }}
                                @if ($program->ends_at && ! $program->ends_at->isSameDay($program->starts_at))
                                    – {{ $program->ends_at->format('d/m/Y') }}
                                @endif
                            </dd>
                        </div>
                    @endif
                    @if ($program->t('location'))
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wide text-muted">{{ __('site.training_location') }}</dt>
                            <dd class="mt-1">{{ $program->t('location') }}</dd>
                        </div>
                    @endif
                    @if ($program->t('organizer'))
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wide text-muted">{{ __('site.training_organizer') }}</dt>
                            <dd class="mt-1">{{ $program->t('organizer') }}</dd>
                        </div>
                    @endif
                    @if ($program->t('format'))
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wide text-muted">{{ __('site.training_format') }}</dt>
                            <dd class="mt-1">{{ $program->t('format') }}</dd>
                        </div>
                    @endif
                </dl>

                @if ($program->registration_url)
                    <a href="{{ $program->registration_url }}" target="_blank" rel="noopener" class="btn-primary mt-6 w-full">
                        {{ __('site.training_register') }}
                    </a>
                @endif
            </aside>
        </div>

        @if ($related->isNotEmpty())
            <div class="mt-16 border-t border-vago/10 pt-12">
                <h2 class="font-display text-2xl font-semibold text-vago-deep">{{ __('site.related_posts') }}</h2>
                <div class="mt-6 grid gap-6 sm:grid-cols-3">
                    @foreach ($related as $item)
                        <a href="{{ route('training.show', $item->localizedSlug() ?: $item->slug_vi) }}" class="card group">
                            <div class="aspect-[16/10] overflow-hidden bg-vago/10">
                                @if ($item->featured_image)
                                    <img src="{{ asset('storage/'.$item->featured_image) }}" alt="{{ $item->t('title') }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="text-sm font-semibold text-vago-deep group-hover:text-vago">{{ $item->t('title') }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
