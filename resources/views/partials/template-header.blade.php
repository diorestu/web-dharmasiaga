<header class="main-header main-header-style1">

            <!--Start Main Header Style1 Top-->
            <div class="main-header-style1-top">
                <div class="auto-container">
                    <div class="outer-box">
                        <!--Start Main Header Style1 Top Left-->
                        <div class="main-header-style1-top__left">
                            <div class="looking-banking-box ">
                                <div class="inner-title">
                                    <span class="icon-binoculars"></span>
                                    <p>Layanan</p>
                                </div>
                                <div class="select-box clearfix">
                                    <select class="wide" data-service-select aria-label="Pilih layanan"><option value="service" data-display="Layanan anggota">Layanan anggota</option><option value="simulator">Simulasi keuangan</option><option value="contact">Konsultasi</option></select>
                                </div>
                            </div>
                            <div class="nearest-branch">
                                <span class="icon-map"></span>
                                <a href="{{ route('pages.branches') }}">Kantor layanan</a>
                            </div>
                        </div>
                        <!--End Main Header Style1 Top Left-->

                        <!--Start Main Header Style1 Top Right-->
                        <div class="main-header-style1-top__right">
                            <div class="header-menu-style1">
                                <ul>
                                    <li><a href="{{ route('pages.about') }}">Tentang</a></li>
                                    <li><a href="{{ route('home') }}#faq">FAQ</a></li>
                                    <li><a href="{{ route('home') }}#service">Produk</a></li>
                                    <li><a href="{{ route('pages.reports') }}">Laporan</a></li>
                                </ul>
                            </div>
                            <div class="box-search-style1">
                                <a href="#" class="search-toggler">
                                    <span class="icon-search"></span>
                                    Cari
                                </a>
                            </div>
                            <div class="language-switcher">
                                <div id="polyglotLanguageSwitcher">
                                    <form action="#">
                                        <select id="member-language-options"><option id="id" value="id" selected>Indonesia</option><option id="en" value="en">English</option></select>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--End Main Header Style1 Top Right-->

                    </div>
                </div>
            </div>
            <!--End Main Header Style1 Top-->

            <nav class="main-menu main-menu-style1">
                <div class="main-menu__wrapper clearfix">
                    <div class="container">
                        <div class="main-menu__wrapper-inner">

                            <div class="main-menu-style1-left">
                                <div class="logo-box-style1">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('images/dharma-siaga-logo-light.svg') }}" alt="KSP Dharma Siaga" title="">
                                    </a>
                                </div>

                                <div class="main-menu-box">
                                    <a href="#" class="mobile-nav__toggler" aria-label="Buka menu">
                                        <i class="icon-menu"></i>
                                    </a>
                                    <ul class="main-menu__list">
<li><a href="{{ route('home') }}">Beranda</a></li>
<li class="dropdown"><a href="{{ route('home') }}#service">Produk</a><ul><li><a href="{{ route('home') }}#service">Simpanan &amp; pinjaman</a></li><li><a href="{{ route('home') }}#simulator">Simulasi keuangan</a></li></ul></li>
<li class="dropdown"><a href="{{ route('pages.about') }}">Tentang</a><ul><li><a href="{{ route('pages.about') }}">Profil koperasi</a></li><li><a href="{{ route('pages.branches') }}">Kantor layanan</a></li></ul></li>
<li><a href="{{ route('blog.index') }}">Catatan</a></li><li><a href="{{ route('pages.reports') }}">Laporan</a></li><li><a href="{{ route('home') }}#contact">Kontak</a></li></ul>
                                </div>
                            </div>

                            <div class="main-menu-style1-right">
                                <div class="header-btn-one">
                                    <a href="{{ route('pages.reports') }}">
                                        <span class="icon-home-button"></span>Laporan
                                    </a>
                                    <a class="style2" href="{{ route('home') }}#contact">
                                        <span class="icon-payment"></span>Gabung anggota
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </nav>

            <!--Start Main Header Style1 Bottom-->
            <div class="main-header-style1-bottom">
                <div class="auto-container">
                    <div class="outer-box">
                        <div class="update-box">
                            <div class="inner-title">
                                <span class="icon-megaphone"></span>
                                <h4>Info:</h4>
                            </div>
                            <div class="text">
                                <p>Kenali simpanan dan pinjaman untuk anggota.</p>
                                <a href="{{ route('home') }}#contact"><span class="icon-chevron"></span>Selengkapnya</a>
                            </div>
                        </div>
                        <div class="slogan-box">
                            <p>KSP Dharma Siaga — tumbuh bersama anggota di Denpasar.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Main Header Style1 Bottom-->

        </header>
<div class="stricky-header stricked-menu main-menu"><div class="sticky-header__content"></div></div>
