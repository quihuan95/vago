@props([
    'title',
    'subtitle' => null,
])

<section class="relative overflow-hidden border-b border-vago/10 bg-vago-deep">
    <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(circle at 20% 20%, #0a6eb8 0%, transparent 45%), radial-gradient(circle at 80% 0%, #d45a1a 0%, transparent 35%);"></div>
    <div class="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8">
        <p class="animate-fade-up text-xs font-semibold uppercase tracking-[0.22em] text-white/60">VAGO</p>
        <h1 class="animate-fade-up-delay mt-3 max-w-4xl font-display text-4xl font-semibold leading-tight text-white sm:text-5xl lg:text-6xl">
            {{ $title }}
        </h1>
        @if ($subtitle)
            <p class="animate-fade-up-delay-2 mt-4 max-w-2xl text-base leading-relaxed text-white/75 sm:text-lg">
                {{ $subtitle }}
            </p>
        @endif
        <div class="animate-draw-line mt-8 h-1 w-28 bg-accent-warm"></div>
    </div>
</section>
