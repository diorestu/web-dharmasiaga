@php($seo = app(\App\Support\Seo::class)->metadata(request(), $content ?? []))
<title>{{ $seo['title'] }}</title>
<meta name="description" content="{{ $seo['description'] }}">
<meta name="robots" content="{{ $seo['robots'] }}">
<link rel="canonical" href="{{ $seo['canonical'] }}">
<meta property="og:type" content="website">
<meta property="og:locale" content="id_ID">
<meta property="og:site_name" content="KSP Dharma Siaga">
<meta property="og:title" content="{{ $seo['title'] }}">
<meta property="og:description" content="{{ $seo['description'] }}">
<meta property="og:url" content="{{ $seo['canonical'] }}">
<meta property="og:image" content="{{ $seo['image'] }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:type" content="image/jpeg">
<meta property="og:image:alt" content="KSP Dharma Siaga, koperasi simpan pinjam di Denpasar, Bali">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seo['title'] }}">
<meta name="twitter:description" content="{{ $seo['description'] }}">
<meta name="twitter:image" content="{{ $seo['image'] }}">
<meta name="twitter:image:alt" content="KSP Dharma Siaga, koperasi simpan pinjam di Denpasar, Bali">
<meta name="theme-color" content="#8a0f3d">
<link rel="icon" href="{{ asset('favicon.ico') }}?v={{ filemtime(public_path('favicon.ico')) }}" sizes="any">
<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon-96x96.png') }}?v={{ filemtime(public_path('favicon-96x96.png')) }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v={{ filemtime(public_path('apple-touch-icon.png')) }}">
<link rel="manifest" href="{{ asset('site.webmanifest') }}">
@if(config('seo.google_verification'))
<meta name="google-site-verification" content="{{ config('seo.google_verification') }}">
@endif
@if(config('seo.bing_verification'))
<meta name="msvalidate.01" content="{{ config('seo.bing_verification') }}">
@endif
@if(app(\App\Support\Seo::class)->isPublicPage(request()))
<script type="application/ld+json">{!! json_encode($seo['schema'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_THROW_ON_ERROR) !!}</script>
@endif
