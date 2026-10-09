@extends('layouts.finbank')
@php($title = 'Tentang Kami — KSP Dharma Siaga')
@section('content')
<section class="breadcrumb-area">
            <div class="breadcrumb-area-bg"
                style="background-image: url({{ asset('assets/images/resources/dharma-about.png') }});"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="inner-content">
                            <div class="title" data-aos="fade-right" data-aos-easing="linear" data-aos-duration="500">
                                <h2>Tentang kami</h2>
                            </div>
                            <div class="breadcrumb-menu" data-aos="fade-left" data-aos-easing="linear"
                                data-aos-duration="500">
                                <ul>
                                    <li><a href="{{ route('home') }}">Beranda</a></li>
                                    <li class="active">Tentang kami</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@include('partials.template-about')
<section id="principles" class="choose-style1-area">
            <div class="container">
                <ul class="row choose-style1__content">

                    <!--Start Single Choose Style1-->
                    <li class="col-xl-4 col-lg-4 single-choose-style1-colum text-center">
                        <div class="single-choose-style1">
                            <div class="icon">
                                <div class="icon-inner">
                                    <span class="icon-crowd"></span>
                                </div>
                                <div class="counting">01</div>
                            </div>
                            <div class="text">
                                <h3>Berbasis anggota</h3>
                                <p>Simpanan dan partisipasi anggota menjadi bagian dari pertumbuhan bersama.</p>
                            </div>
                        </div>
                    </li>
                    <!--End Single Choose Style1-->

                    <!--Start Single Choose Style1-->
                    <li class="col-xl-4 col-lg-4 single-choose-style1-colum text-center">
                        <div class="single-choose-style1">
                            <div class="icon">
                                <div class="icon-inner">
                                    <span class="icon-commitment"></span>
                                </div>
                                <div class="counting">02</div>
                            </div>
                            <div class="text">
                                <h3>Bertanggung jawab</h3>
                                <p>Keputusan layanan mempertimbangkan kebutuhan dan kemampuan anggota.</p>
                            </div>
                        </div>
                    </li>
                    <!--End Single Choose Style1-->

                    <!--Start Single Choose Style1-->
                    <li class="col-xl-4 col-lg-4 single-choose-style1-colum text-center">
                        <div class="single-choose-style1">
                            <div class="icon">
                                <div class="icon-inner">
                                    <span class="icon-consistency"></span>
                                </div>
                                <div class="counting">03</div>
                            </div>
                            <div class="text">
                                <h3>Terbuka</h3>
                                <p>Informasi layanan dan ketentuan dijelaskan agar mudah dipahami.</p>
                            </div>
                        </div>
                    </li>
                    <!--End Single Choose Style1-->

                </ul>
            </div>
        </section>
@endsection
