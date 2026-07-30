@extends('layouts.app')

@section('title', __('site.search_title').' — VAGO')
@section('description', __('site.search_title').' — Hội Phụ sản Việt Nam (VAGO).')

@section('content')
    @include('partials.page-hero', [
        'title' => __('site.search_title'),
        'subtitle' => $query !== '' ? __('site.search_results_for', ['query' => $query]) : null,
    ])

    @include('partials.breadcrumb', ['items' => [
        ['label' => __('site.search_title')],
    ]])

    <div class="mx-auto max-w-5xl px-4 py-16 sm:px-6 lg:px-8">
        <form action="{{ route('search') }}" method="get" class="mb-10 flex">
            <label for="q" class="sr-only">{{ __('site.nav_search') }}</label>
            <input
                id="q"
                type="search"
                name="q"
                value="{{ $query }}"
                placeholder="{{ __('site.search_placeholder') }}"
                class="form-input rounded-r-none"
            >
            <button type="submit" class="btn-primary rounded-l-none">{{ __('site.search_button') }}</button>
        </form>

        @if ($query === '')
            <p class="text-muted">{{ __('site.search_placeholder') }}</p>
        @elseif ($results->isEmpty())
            <p class="text-muted">{{ __('site.no_results') }}</p>
        @else
            <ul class="divide-y divide-vago/10 border-y border-vago/10">
                @foreach ($results as $result)
                    <li class="flex flex-col gap-4 py-6 sm:flex-row">
                        @if (!empty($result['image']))
                            <a href="{{ $result['url'] }}" class="block h-24 w-32 shrink-0 overflow-hidden rounded-sm bg-vago/10">
                                <img src="{{ asset('storage/'.$result['image']) }}" alt="{{ $result['title'] }}" class="h-full w-full object-cover" loading="lazy">
                            </a>
                        @endif
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-wrap items-center gap-2 text-xs">
                                <span class="rounded-full bg-vago/10 px-2.5 py-1 font-semibold uppercase tracking-wide text-vago-dark">{{ $result['type'] }}</span>
                                @if (!empty($result['date']))
                                    <span class="text-muted">{{ \Illuminate\Support\Carbon::parse($result['date'])->format('d/m/Y') }}</span>
                                @endif
                            </div>
                            <a href="{{ $result['url'] }}" class="mt-2 block font-display text-lg font-semibold text-vago-deep hover:text-vago">
                                {{ $result['title'] }}
                            </a>
                            @if (!empty($result['excerpt']))
                                <p class="mt-2 text-sm leading-relaxed text-muted">{{ \Illuminate\Support\Str::limit($result['excerpt'], 160) }}</p>
                            @endif
                            <a href="{{ $result['url'] }}" class="mt-2 inline-block text-sm font-semibold text-vago hover:text-vago-dark">{{ __('site.read_more') }} →</a>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="mt-12">
                {{ $results->links() }}
            </div>
        @endif
    </div>
@endsection
