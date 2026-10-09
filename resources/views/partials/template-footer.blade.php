<footer class="footer-area">
            <div class="right-shape">
                <img src="{{ asset('assets/images/shapes/footer-right-shape.png') }}" alt="">
            </div>

            <!--Start Footer Top-->
            <div class="footer-top">
                <div class="lef-shape">
                    <span class="icon-origami"></span>
                </div>
                <div class="container">
                    <div class="row">
                        <!--Start single footer widget-->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 single-widget">
                            <div class="single-footer-widget single-footer-widget--link-box">
                                <div class="title">
                                    <h3>Keanggotaan</h3>
                                </div>
                                <div class="footer-widget-links">
                                    <ul><li><a href="{{ route('home') }}#contact">Cara bergabung</a></li><li><a href="{{ route('home') }}#service">Simpanan anggota</a></li><li><a href="{{ route('home') }}#service">Pinjaman anggota</a></li><li><a href="{{ route('home') }}#benefits">Manfaat keanggotaan</a></li></ul>
                                </div>
                            </div>
                        </div>
                        <!--End single footer widget-->
                        <!--Start single footer widget-->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 single-widget">
                            <div class="single-footer-widget single-footer-widget--link-box">
                                <div class="title">
                                    <h3>Informasi</h3>
                                </div>
                                <div class="footer-widget-links">
                                    <ul><li><a href="{{ route('pages.reports') }}">Laporan koperasi</a></li><li><a href="{{ route('home') }}#assets">Ringkasan indikatif</a></li><li><a href="{{ route('home') }}#contact">Ketentuan produk</a></li></ul>
                                </div>
                            </div>
                            <div class="single-footer-widget single-footer-widget--link-box-style2">
                                <div class="title">
                                    <h3>Perencanaan</h3>
                                </div>
                                <div class="footer-widget-links">
                                    <ul><li><a href="{{ route('home') }}#simulator">Simulasi pinjaman</a></li><li><a href="{{ route('home') }}#simulator">Simulasi simpanan</a></li></ul>
                                </div>
                            </div>
                        </div>
                        <!--End single footer widget-->

                        <!--Start single footer widget-->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 single-widget">
                            <div class="single-footer-widget single-footer-widget--link-box">
                                <div class="title">
                                    <h3>Tentang kami</h3>
                                </div>
                                <div class="footer-widget-links">
                                    <ul><li><a href="{{ route('pages.about') }}">Profil koperasi</a></li><li><a href="{{ route('pages.about') }}#principles">Prinsip koperasi</a></li><li><a href="{{ route('pages.branches') }}">Kantor layanan</a></li><li><a href="{{ route('blog.index') }}">Catatan koperasi</a></li></ul>
                                </div>
                            </div>
                        </div>
                        <!--End single footer widget-->

                        <!--Start single footer widget-->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 single-widget">
                            <div class="single-footer-widget single-footer-widget--link-box">
                                <div class="title">
                                    <h3>Layanan</h3>
                                </div>
                                <div class="footer-widget-links">
                                    <ul><li><a href="{{ route('home') }}#contact">Konsultasi simpanan</a></li><li><a href="{{ route('home') }}#contact">Konsultasi pinjaman</a></li><li><a href="{{ route('home') }}#contact">Informasi anggota</a></li><li><a href="{{ route('home') }}#faq">Pertanyaan umum</a></li></ul>
                                </div>
                            </div>
                        </div>
                        <!--End single footer widget-->
                    </div>
                </div>
            </div>
            <!--End Footer Top-->

            <!--Start Footer-->
            <div class="footer">
                <div class="container">
                    <div class="row">

                        <!--Start single footer widget-->
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                            <div class="single-footer-widget marbtm50">
                                <div class="our-company-info">
                                    <div class="footer-logo-style1">
                                        <a href="{{ route('home') }}">
                                            <img src="{{ asset('images/dharma-siaga-logo-light.svg') }}" alt="KSP Dharma Siaga"
                                                title="">
                                        </a>
                                    </div>
                                    <div class="copyright-text">
                                        <p>
                                            Copyright &copy; {{ date("Y") }} <a href="{{ route('home') }}">KSP Dharma Siaga.</a> Koperasi simpan pinjam<br> di Denpasar, Bali.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End single footer widget-->

                        <!--Start single footer widget-->
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                            <div class="single-footer-widget marbtm50">
                                <div class="footer-widget-contact-info">
                                    <ul>
                                        <li>
                                            <h3>
                                                <a href="{{ route('home') }}#contact">Hubungi layanan</a>
                                            </h3>
                                            <p>Konsultasi anggota</p>
                                        </li>
                                        <li>
                                            <h3>Denpasar, Bali</h3>
                                            <p>Konfirmasi jam layanan melalui tim kami</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--End single footer widget-->

                        <!--Start single footer widget-->
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                            <div class="single-footer-widget">
                                <div class="single-footer-widget-right-colum">
                                    <ul>
                                        <li>
                                            <a href="{{ route('pages.reports') }}">
                                                Laporan koperasi
                                                <span class="icon-download"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('home') }}#contact">
                                                Hubungi tim kami
                                                <span class="icon-feedback"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--End single footer widget-->

                    </div>
                </div>
            </div>
            <!--End Footer-->

            <div class="footer-bottom">
                <div class="container">
                    <div class="bottom-inner">
                        <div class="footer-menu">
                            <ul>
                                <li><a href="{{ route('home') }}#contact">Informasi resmi</a></li>
                                <li><a href="{{ route('pages.about') }}">Profil koperasi</a></li>
                                <li><a href="{{ route('home') }}#contact">Ketentuan layanan</a></li>
                                <li><a href="{{ route('home') }}#faq">Pertanyaan anggota</a></li>
                            </ul>
                        </div>
                        <div class="footer-social-link"><ul class="clearfix"><li><a href="{{ route('home') }}#contact" aria-label="Hubungi koperasi"><i class="fas fa-envelope"></i></a></li></ul></div>
                    </div>
                </div>
            </div>

        </footer>
