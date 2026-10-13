@extends('layouts.finbank')
@php($title = 'Sejarah Kami — KSP Dharma Siaga')
@section('content')
@include('partials.template-breadcrumb', ['pageTitle' => 'Sejarah Kami'])
<section class="intro-style1-area"><div class="container"><div class="row">
    <div class="col-xl-5 mb-4"><div class="intro-style1-video-gallery" role="img" aria-label="Ilustrasi kegiatan anggota koperasi di Bali"><div class="intro-style1-video-gallery-bg" style="background-image: url({{ asset('assets/images/resources/dharma-about.png') }});"></div></div></div>
    <div class="col-xl-7"><div class="intro-style1-content-box">
        <div class="sec-title"><h2>{{ config('cooperative.history.tagline') }}</h2></div>
        <div class="text text-dark">@foreach(config('cooperative.history.paragraphs') as $paragraph)<p>{{ $paragraph }}</p>@endforeach</div>
        <a class="btn-one" href="{{ route('pages.about') }}"><span class="txt">Profil Koperasi</span></a>
    </div></div>
</div></div></section>
@endsection
