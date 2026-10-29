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
                                    <ul><li><a href="{{ route('home') }}#contact">Cara bergabung</a></li><li><a href="{{ route('pages.savings.show', 'simpanan-anggota') }}">Simpanan anggota</a></li><li><a href="{{ route('pages.loans') }}">Pinjaman anggota</a></li><li><a href="{{ route('pages.membership') }}">Program membership</a></li><li><a href="{{ route('home') }}#benefits">Manfaat keanggotaan</a></li></ul>
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
                                    <ul><li><a href="{{ route('home') }}#contact">Ketentuan produk</a></li></ul>
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
                                    <ul><li><a href="{{ route('pages.history') }}">Sejarah Kami</a></li><li><a href="{{ route('pages.about') }}">Profil Koperasi</a></li><li><a href="{{ route('pages.about') }}#principles">Prinsip koperasi</a></li><li><a href="{{ route('pages.branches') }}">Kantor layanan</a></li><li><a href="{{ route('blog.index') }}">Berita koperasi</a></li></ul>
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
                                    <ul><li><a href="{{ route('pages.savings') }}">Pilihan Simpanan</a></li><li><a href="{{ route('pages.loans') }}">Pinjaman Koperasi</a></li><li><a href="{{ route('loan-applications.create') }}">Pengajuan Pinjaman Online</a></li><li><a href="{{ route('pages.membership') }}">Program Membership</a></li><li><a href="{{ route('home') }}#contact">Konsultasi layanan</a></li><li><a href="{{ route('home') }}#faq">Pertanyaan umum</a></li></ul>
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
                                                <a href="tel:03618466651">{{ config('cooperative.office.telephone_display') }}</a>
                                            </h3>
                                            <p>Konsultasi anggota</p>
                                        </li>
                                        <li>
                                            <h3>Lokasi Kantor</h3>
                                            <p>{{ config('cooperative.office.address') }}</p>
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
                                            <a href="https://wa.me/{{ config('cooperative.office.whatsapp_number') }}" target="_blank" rel="noopener noreferrer">
                                                WhatsApp: {{ config('cooperative.office.whatsapp_display') }}
                                                <span class="icon-chatting"></span>
                                            </a>
                                        </li>
                                        <li class="mt-2">
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
                                <li><a href="{{ route('pages.history') }}">Sejarah Kami</a></li><li><a href="{{ route('pages.about') }}">Profil Koperasi</a></li>
                                <li><a href="{{ route('pages.loans') }}">Pinjaman</a></li>
                                <li><a href="{{ route('pages.membership') }}">Membership</a></li>
                                <li><a href="{{ route('home') }}#faq">Pertanyaan anggota</a></li>
                            </ul>
                        </div>
                        <div class="footer-social-link">
                            <ul class="clearfix">
                                <li><a href="{{ config('cooperative.social_media.facebook.url') }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook KSP Dharma Siaga"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="{{ config('cooperative.social_media.instagram.url') }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram KSP Dharma Siaga"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="{{ config('cooperative.social_media.tiktok.url') }}" target="_blank" rel="noopener noreferrer" aria-label="TikTok KSP Dharma Siaga"><i class="fab fa-tiktok"></i></a></li>
                                <li><a href="https://wa.me/{{ config('cooperative.office.whatsapp_number') }}" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp KSP Dharma Siaga"><i class="fab fa-whatsapp"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </footer>
