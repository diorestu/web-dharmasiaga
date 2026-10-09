@extends('layouts.finbank')
@php($title = 'Catatan Koperasi — KSP Dharma Siaga')
@section('content')
<section class="breadcrumb-area">
            <div class="breadcrumb-area-bg"
                style="background-image: url({{ asset('assets/images/resources/dharma-about.png') }});"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="inner-content">
                            <div class="title" data-aos="fade-right" data-aos-easing="linear" data-aos-duration="500">
                                <h2>Catatan koperasi</h2>
                            </div>
                            <div class="breadcrumb-menu" data-aos="fade-left" data-aos-easing="linear"
                                data-aos-duration="500">
                                <ul>
                                    <li><a href="{{ route('home') }}">Beranda</a></li>
                                    <li class="active">Catatan koperasi</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><section class="blog-page-one"><div class="container"><div class="row">@foreach($posts as $post)
<div class="col-xl-4 col-lg-4">
                        <div id="catatan-{{ $loop->iteration }}" class="single-blog-style1 wow fadeInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="img-holder">
                                <div class="inner">
                                    <img src="{{ asset($loop->index === 1 ? 'assets/images/slides/dharma-business.png' : 'assets/images/resources/dharma-about.png') }}" alt="Ilustrasi kegiatan anggota dan usaha lokal di Bali">
                                    <div class="overlay-icon">
                                        <a href="{{ $loop->index === 0 ? route('pages.reports') : ($loop->index === 1 ? route('home').'#service' : route('pages.branches')) }}">
                                            <span class="icon-right-arrow"></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="category-date-box">
                                    <div class="category">
                                        <span class="icon-play-button-1"></span>
                                        <h5>Koperasi</h5>
                                    </div>
                                    <div class="date">
                                        <h5>{{ $post['date'] }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="text-holder">
                                <h3 class="blog-title">
                                    <a href="{{ $loop->index === 0 ? route('pages.reports') : ($loop->index === 1 ? route('home').'#service' : route('pages.branches')) }}">
                                        {{ $post['title'] }}
                                    </a>
                                </h3>
                                <div class="bottom"><div class="meta-box"><p>{{ $post['excerpt'] }}</p></div></div>
                            </div>
                        </div>
                    </div>
                    <!--End Single blog Style1-->
@endforeach</div></div></section>
@endsection
