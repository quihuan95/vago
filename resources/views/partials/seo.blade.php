@php
    $defaultSeoTitle = \App\Models\Setting::getValue(\App\Support\Locale::field('default_seo_title'));
    $defaultSeoDescription = \App\Models\Setting::getValue(\App\Support\Locale::field('default_seo_description'));
    $logo = \App\Models\Setting::getValue('logo');

    $seoTitle = trim($seoTitle ?? '') ?: ($defaultSeoTitle ?: __('site.site_name').' — VAGO');
    $seoDescription = trim($seoDescription ?? '') ?: ($defaultSeoDescription ?: __('site.updating'));
    $seoImage = $seoImage ?? asset('images/hero-banner.jpg');
    $canonicalUrl = $canonicalUrl ?? url()->current();
    $orgLogo = $logo ? asset('storage/'.$logo) : asset('images/logo.jpg');
@endphp

<title>{{ $seoTitle }}</title>
<meta name="description" content="{{ $seoDescription }}">
<link rel="canonical" href="{{ $canonicalUrl }}">

{{-- hreflang: alternate language versions of the current URL --}}
<link rel="alternate" hreflang="vi" href="{{ $canonicalUrl }}">
<link rel="alternate" hreflang="en" href="{{ $canonicalUrl }}">
<link rel="alternate" hreflang="x-default" href="{{ $canonicalUrl }}">

{{-- Open Graph --}}
<meta property="og:site_name" content="VAGO — {{ __('site.site_name') }}">
<meta property="og:type" content="website">
<meta property="og:locale" content="{{ \App\Support\Locale::current() === 'en' ? 'en_US' : 'vi_VN' }}">
<meta property="og:title" content="{{ $seoTitle }}">
<meta property="og:description" content="{{ $seoDescription }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:image" content="{{ $seoImage }}">

{{-- Twitter --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoTitle }}">
<meta name="twitter:description" content="{{ $seoDescription }}">
<meta name="twitter:image" content="{{ $seoImage }}">

<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => 'Hội Phụ sản Việt Nam (VAGO)',
    'alternateName' => 'Vietnam Association of Gynecology and Obstetrics',
    'url' => url('/'),
    'logo' => $orgLogo,
    'email' => \App\Models\Setting::getValue('contact_email', 'vago.vn@gmail.com'),
    'telephone' => \App\Models\Setting::getValue('contact_phone', '024.9346743'),
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => 'Tầng 7, nhà G, Bệnh viện Phụ sản Trung ương, Số 1 Phố Triệu Quốc Đạt',
        'addressLocality' => 'Phường Cửa Nam',
        'addressRegion' => 'TP. Hà Nội',
        'addressCountry' => 'VN',
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>
