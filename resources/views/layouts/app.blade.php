<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'KSP Dharma Siaga' }}</title>
    <meta name="description" content="{{ $description ?? ($content['meta_description'] ?? 'Koperasi yang menghubungkan anggota, modal, dan kesempatan secara terbuka.') }}">
    <meta name="keywords" content="koperasi, simpan pinjam, anggota, kemitraan, Indonesia">
    <link rel="icon" type="image/jpeg" href="{{ asset('images/ksp-dharma-siaga-logo.jpeg') }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title ?? 'KSP Dharma Siaga' }}">
    <meta property="og:description" content="{{ $description ?? ($content['meta_description'] ?? 'Koperasi yang menghubungkan anggota, modal, dan kesempatan secara terbuka.') }}">
    <meta property="og:image" content="{{ asset('images/ksp-dharma-siaga-logo.jpeg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<a class="skip-link" href="#main-content">Lewati ke konten utama</a>
@yield('content')
</body>
</html>
