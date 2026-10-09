@extends('layouts.finbank')
@php($title = 'Laporan koperasi — KSP Dharma Siaga')
@section('content')
<section class="breadcrumb-area">
            <div class="breadcrumb-area-bg"
                style="background-image: url({{ asset('assets/images/resources/dharma-about.png') }});"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="inner-content">
                            <div class="title" data-aos="fade-right" data-aos-easing="linear" data-aos-duration="500">
                                <h2>Laporan koperasi</h2>
                            </div>
                            <div class="breadcrumb-menu" data-aos="fade-left" data-aos-easing="linear"
                                data-aos-duration="500">
                                <ul>
                                    <li><a href="{{ route('home') }}">Beranda</a></li>
                                    <li class="active">Laporan koperasi</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><section class="features-style1-area"><div class="container"><div class="sec-title text-center"><h2>Laporan koperasi</h2><div class="sub-title"><p>Ringkasan dan dokumen koperasi yang telah disetujui untuk publikasi.</p></div></div><div class="faq-style1-bottom-box text-center"><p>Belum ada laporan resmi yang dipublikasikan. Data indikatif bukan pengganti laporan keuangan.</p><div class="btns-box"><a class="btn-one" href="{{ route('home') }}#assets"><span class="txt">Lihat ringkasan indikatif</span></a></div></div></div></section>
@endsection
