<!DOCTYPE html>
<html lang="{{ \App\Support\Locale::current() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('partials.seo', [
        'seoTitle' => trim($__env->yieldContent('title', '')),
        'seoDescription' => trim($__env->yieldContent('description', '')),
        'seoImage' => $seoImage ?? null,
        'canonicalUrl' => $canonicalUrl ?? null,
    ])

    @php $favicon = \App\Models\Setting::getValue('favicon'); @endphp
    <link rel="icon" href="{{ $favicon ? asset('storage/'.$favicon) : asset('images/logo.jpg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-screen flex flex-col">
    @include('partials.nav')

    <main class="flex-1">
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
