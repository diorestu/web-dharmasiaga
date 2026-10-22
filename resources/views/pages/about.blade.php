@extends('layouts.finbank')
@php($title = 'Profil Koperasi — KSP Dharma Siaga')
@section('content')
@include('partials.template-breadcrumb', ['pageTitle' => 'Profil Koperasi', 'bgImage' => 'assets/images/resources/dharma-office-angle.jpeg'])
<section class="choose-style1-area"><div class="container">
    <div class="sec-title text-center pt-5"><h2>Pengurus dan Pengawas</h2></div>
    <ul class="row choose-style1__content">
        @foreach(config('cooperative.leadership') as $person)
        <li class="col-xl-4 col-lg-4 single-choose-style1-colum text-center"><div class="single-choose-style1">
            <div class="leadership-photo"><img src="{{ asset($person['photo']) }}" alt="{{ $person['name'] }}, {{ $person['role'] }}" width="640" height="640" loading="lazy" decoding="async"></div>
            <div class="text"><h3>{{ $person['role'] }}</h3><p class="text-dark">{{ $person['name'] }}</p></div>
        </div></li>
        @endforeach
    </ul>
</div></section>
<section class="overview-area" id="principles"><div class="container"><div class="row">
    <div class="col-lg-5 mb-4"><div class="overview-content-box-two"><div class="inner-title"><h2>Visi</h2></div><div class="text text-dark"><p>{{ config('cooperative.vision') }}</p></div></div></div>
    <div class="col-lg-7"><div class="overview-content-box-two"><div class="inner-title"><h2>Misi</h2></div><div class="text text-dark"><ol class="ps-4">@foreach(config('cooperative.missions') as $mission)<li class="mb-3"><span aria-hidden="true">{{ $loop->iteration }}.</span> {{ $mission }}</li>@endforeach</ol></div></div></div>
</div></div></section>
<section class="features-style1-area"><div class="container"><div class="row"><div class="col-lg-10 offset-lg-1">
    <div class="sec-title"><h2>Legalitas Koperasi</h2></div>
    <dl class="row text-dark">@foreach(config('cooperative.legalities') as $label => $value)<dt class="col-sm-3 mb-2">{{ $label }}</dt><dd class="col-sm-9 mb-4 text-break">{{ $value }}</dd>@endforeach</dl>
    <div class="faq-style1-bottom-box text-center"><div class="btns-box"><a class="btn-one" href="{{ route('pages.history') }}"><span class="txt">Sejarah Kami</span></a></div></div>
</div></div></div></section>
@endsection
