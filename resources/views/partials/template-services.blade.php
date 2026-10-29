<section id="service" class="service-style1-area">
            <div class="service-style1-bg" style="background-image: url({{ asset('assets/images/resources/dharma-loan-service.jpeg') }});">
            </div>
            <div class="container">

                <div class="row">
                    <div class="col-xl-12">
                        <div class="service-style1-title">
                            <div class="sec-title">
                                <h2>Layanan untuk kebutuhan Anda</h2>
                                <div class="sub-title">
                                    <p>Simpanan dan pinjaman yang dipahami bersama.</p>
                                </div>
                            </div>
                            <div class="get-assistant-box">
                                <a href="{{ route('home') }}#contact"><span class="icon-chatting"></span></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="service-style1-tab">
                            <!--Start Service Style1 Tab Button-->
                            <div class="service-style1-tab__button">
                                <ul class="tabs-button-box clearfix">
                                    <li data-tab="#individuals" class="tab-btn-item">
                                        <div class="inner">
                                            <div class="left">
                                                <h4>Layanan untuk</h4>
                                                <h3>Simpanan & Membership</h3>
                                            </div>
                                            <div class="right">
                                                <span class="icon-down-arrow"></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li data-tab="#companies" class="tab-btn-item active-btn-item">
                                        <div class="inner">
                                            <div class="left">
                                                <h4>Layanan untuk</h4>
                                                <h3>Pinjaman & Usaha</h3>
                                            </div>
                                            <div class="right">
                                                <span class="icon-down-arrow"></span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!--End Service Style1 Tab Button-->

                            <!--Start Tabs Content Box-->
                            <div class="tabs-content-box">

                                <!--Tab-->
                                <div class="tab-content-box-item" id="individuals">
                                    <div class="service-style1-tab-content-box-item">
                                        <div class="row">
                                            <!--Start Single Service Box Style1-->
                                            <div class="col-xl-4 col-lg-4">
                                                <div class="single-service-box-style1">
                                                    <div class="icon">
                                                        <span class="icon-safebox"></span>
                                                    </div>
                                                    <h3><a href="{{ route('pages.savings') }}">Pilihan Simpanan</a></h3>
                                                    <div class="border-box"></div>
                                                    <p>Simpanan Anggota, SIDUTA, Sukarela, Siaga, Berjangka, dan SAHAM.</p>
                                                    <h6><span>*</span> Menguntungkan & aman</h6>
                                                    <div class="btn-box">
                                                        <a href="{{ route('pages.savings') }}"><span class="icon-right-arrow"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--End Single Service Box Style1-->
                                            <!--Start Single Service Box Style1-->
                                            <div class="col-xl-4 col-lg-4">
                                                <div class="single-service-box-style1">
                                                    <div class="icon">
                                                        <span class="icon-online"></span>
                                                    </div>
                                                    <h3><a href="{{ route('pages.membership') }}">Membership Plus</a></h3>
                                                    <div class="border-box"></div>
                                                    <p>Kolaborasi BPJS Ketenagakerjaan: Jaminan tutup usia, kecelakaan kerja & beasiswa anak.</p>
                                                    <h6><span>*</span> Perlindungan menyeluruh</h6>
                                                    <div class="btn-box">
                                                        <a href="{{ route('pages.membership') }}"><span class="icon-right-arrow"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--End Single Service Box Style1-->
                                            <!--Start Single Service Box Style1-->
                                            <div class="col-xl-4 col-lg-4">
                                                <div class="single-service-box-style1">
                                                    <div class="icon">
                                                        <span class="icon-loan"></span>
                                                    </div>
                                                    <h3><a href="{{ route('pages.membership') }}">Silver & Gold</a></h3>
                                                    <div class="border-box"></div>
                                                    <p>Fasilitas pinjaman eksklusif bunga 1% dengan limit hingga Rp 20 Juta.</p>
                                                    <h6><span>*</span> Proses prioritas</h6>
                                                    <div class="btn-box">
                                                        <a href="{{ route('pages.membership') }}"><span class="icon-right-arrow"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--End Single Service Box Style1-->
                                        </div>
                                    </div>
                                </div>

                                <!--Tab-->
                                <div class="tab-content-box-item tab-content-box-item-active" id="companies">
                                    <div class="service-style1-tab-content-box-item">
                                        <div class="row">
                                            <!--Start Single Service Box Style1-->
                                            <div class="col-xl-4 col-lg-4">
                                                <div class="single-service-box-style1">
                                                    <div class="icon">
                                                        <span class="icon-safebox"></span>
                                                    </div>
                                                    <h3><a href="{{ route('pages.loans') }}">Pinjaman Konsumtif</a></h3>
                                                    <div class="border-box"></div>
                                                    <p>Fasilitas pinjaman produktif & multiguna jaminan BPKB atau SHM tanah/bangunan.</p>
                                                    <h6><span>*</span> BPKB / SHM</h6>
                                                    <div class="btn-box">
                                                        <a href="{{ route('pages.loans') }}"><span class="icon-right-arrow"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--End Single Service Box Style1-->
                                            <!--Start Single Service Box Style1-->
                                            <div class="col-xl-4 col-lg-4">
                                                <div class="single-service-box-style1">
                                                    <div class="icon">
                                                        <span class="icon-online"></span>
                                                    </div>
                                                    <h3><a href="{{ route('pages.loans') }}">Pinjaman UMKM</a></h3>
                                                    <div class="border-box"></div>
                                                    <p>Bunga ringan HANYA 1,4% per bulan, proses cepat, tenor fleksibel hingga 5 tahun.</p>
                                                    <h6><span>*</span> Khusus pelaku UMKM</h6>
                                                    <div class="btn-box">
                                                        <a href="{{ route('pages.loans') }}"><span class="icon-right-arrow"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--End Single Service Box Style1-->
                                            <!--Start Single Service Box Style1-->
                                            <div class="col-xl-4 col-lg-4">
                                                <div class="single-service-box-style1">
                                                    <div class="icon">
                                                        <span class="icon-loan"></span>
                                                    </div>
                                                    <h3><a href="{{ route('home') }}#simulator">Simulasi Pinjaman</a></h3>
                                                    <div class="border-box"></div>
                                                    <p>Hitung estimasi angsuran bulanan sesuai plafon dan tenor pinjaman Anda.</p>
                                                    <h6><span>*</span> Kalkulator interaktif</h6>
                                                    <div class="btn-box">
                                                        <a href="{{ route('home') }}#simulator"><span class="icon-right-arrow"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--End Single Service Box Style1-->
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--End Tabs Content Box-->

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="service-style1__btns-box text-center">
                            <a class="btn-one" href="{{ route('home') }}#contact">
                                <span class="txt">Konsultasikan kebutuhan</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
