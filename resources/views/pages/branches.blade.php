@extends('layouts.finbank')
@php($title = 'Kantor layanan — KSP Dharma Siaga')
@section('content')
<section class="breadcrumb-area">
            <div class="breadcrumb-area-bg"
                style="background-image: url({{ asset('assets/images/resources/dharma-about.png') }});"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="inner-content">
                            <div class="title" data-aos="fade-right" data-aos-easing="linear" data-aos-duration="500">
                                <h2>Kantor layanan</h2>
                            </div>
                            <div class="breadcrumb-menu" data-aos="fade-left" data-aos-easing="linear"
                                data-aos-duration="500">
                                <ul>
                                    <li><a href="{{ route('home') }}">Beranda</a></li>
                                    <li class="active">Kantor layanan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><section class="features-style1-area"><div class="container"><div class="sec-title text-center"><h2>Kantor layanan</h2><div class="sub-title"><p>Temui tim KSP Dharma Siaga di Denpasar, Bali.</p></div></div><div class="faq-style1-bottom-box text-center"><p>Alamat kantor dan jam layanan resmi sedang disiapkan. Hubungi tim untuk informasi terbaru.</p><div class="btns-box"><a class="btn-one" href="{{ route('home') }}#contact"><span class="txt">Tanya titik layanan</span></a></div></div></div></section>
@endsection
