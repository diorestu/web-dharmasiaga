<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'KSP Dharma Siaga' }}</title>
    <meta name="description" content="{{ $description ?? ($content['meta_description'] ?? 'Koperasi yang menghubungkan anggota, modal, dan kesempatan secara terbuka.') }}">
    <meta name="keywords" content="koperasi, simpan pinjam, anggota, kemitraan, Indonesia">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<a class="skip-link" href="#main-content">Lewati ke konten utama</a>
@yield('content')
</body>
</html>
