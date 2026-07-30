@props(['items' => []])

<nav aria-label="Breadcrumb" class="border-b border-vago/10 bg-white/60">
    <ol class="mx-auto flex max-w-7xl flex-wrap items-center gap-2 px-4 py-3 text-xs text-muted sm:px-6 lg:px-8">
        <li class="flex items-center gap-2">
            <a href="{{ route('home') }}" class="font-medium hover:text-vago-dark">{{ __('site.breadcrumb_home') }}</a>
            @if (count($items))
                <span aria-hidden="true">/</span>
            @endif
        </li>
        @foreach ($items as $index => $item)
            <li class="flex items-center gap-2">
                @if (! empty($item['url']) && $index < count($items) - 1)
                    <a href="{{ $item['url'] }}" class="font-medium hover:text-vago-dark">{{ $item['label'] }}</a>
                    <span aria-hidden="true">/</span>
                @else
                    <span class="font-medium text-ink" aria-current="page">{{ $item['label'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
