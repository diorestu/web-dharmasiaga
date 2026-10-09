<section id="home" class="main-slider main-slider-style1">
            <div class="swiper-container thm-swiper__slider" data-swiper-options='{"slidesPerView": 1, "loop": true,
                "effect": "fade",
                "pagination": {
                "el": "#main-slider-pagination",
                "type": "bullets",
                "clickable": true
                },
                "navigation": {
                "nextEl": "#main-slider__swiper-button-next",
                "prevEl": "#main-slider__swiper-button-prev"
                },
                "autoplay": {
                "delay": 5000
                }}'>
                <div class="swiper-wrapper">
                    <div class="slider-buttom-box">
                        <a class="style2" href="{{ route('home') }}#service">Lihat layanan <span class="icon-play-button"></span></a>
                        <a href="{{ route('home') }}#contact">Hubungi kami <span class="icon-play-button"></span></a>
                    </div>

                    <!--Start Single Swiper Slide-->
                    <div class="swiper-slide">
                        <div class="image-layer" style="background-image: url({{ asset('assets/images/slides/dharma-hero.png') }});">
                        </div>
                        <div class="main-slider-style1__shape1"
                            style="background-image: url({{ asset('assets/images/shapes/slider-1-shape-1.png') }});">
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="main-slider-content">
                                        <div class="main-slider-content__inner">
                                            <div class="big-title">
                                                <h2 data-copy-id="{{ $content['hero_title_id'] ?? 'Tumbuh bersama,|untuk masa depan|yang lebih baik.' }}" data-copy-en="{{ $content['hero_title_en'] ?? 'Grow together,|for a better|tomorrow.' }}">@if(!empty($content['hero_title_id'])){{ $content['hero_title_id'] }}@else Tumbuh bersama,<br> untuk masa depan<br> yang lebih baik.@endif</h2>
                                            </div>
                                            <div class="text">
                                                <p>
                                                    KSP Dharma Siaga mendampingi kebutuhan simpanan<br> dan pinjaman anggota di Denpasar, Bali.
                                                </p>
                                            </div>
                                            <div class="btns-box">
                                                <a class="btn-one" href="{{ route('home') }}#contact">
                                                    <span class="txt">
                                                        Konsultasi keanggotaan
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Single Swiper Slide-->

                    <!--Start Single Swiper Slide-->
                    <div class="swiper-slide">
                        <div class="image-layer" style="background-image: url({{ asset('assets/images/slides/dharma-business.png') }});">
                        </div>
                        <div class="main-slider-style1__shape1"
                            style="background-image: url({{ asset('assets/images/shapes/slider-1-shape-1.png') }});">
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="main-slider-content">
                                        <div class="main-slider-content__inner">
                                            <div class="big-title">
                                                <h2>Simpanan terarah,<br> rencana keluarga<br> lebih terjaga.</h2>
                                            </div>
                                            <div class="text">
                                                <p>
                                                    Mulai dari percakapan tentang kebutuhan Anda.<br> Temukan layanan yang sesuai bersama tim koperasi.
                                                </p>
                                            </div>
                                            <div class="btns-box">
                                                <a class="btn-one" href="{{ route('home') }}#contact">
                                                    <span class="txt">
                                                        Konsultasi keanggotaan
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Single Swiper Slide-->

                    <!--Start Single Swiper Slide-->
                    <div class="swiper-slide">
                        <div class="image-layer" style="background-image: url({{ asset('assets/images/slides/dharma-hero.png') }});">
                        </div>
                        <div class="main-slider-style1__shape1"
                            style="background-image: url({{ asset('assets/images/shapes/slider-1-shape-1.png') }});">
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="main-slider-content">
                                        <div class="main-slider-content__inner">
                                            <div class="big-title">
                                                <h2>Dukung usaha,<br> bangun peluang<br> bersama anggota.</h2>
                                            </div>
                                            <div class="text">
                                                <p>
                                                    Mulai dari percakapan tentang kebutuhan Anda.<br> Temukan layanan yang sesuai bersama tim koperasi.
                                                </p>
                                            </div>
                                            <div class="btns-box">
                                                <a class="btn-one" href="{{ route('home') }}#contact">
                                                    <span class="txt">
                                                        Konsultasi keanggotaan
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Single Swiper Slide-->


                </div>

                <!-- If we need navigation buttons -->
                <div class="main-slider__nav">
                    <div class="swiper-button-prev" id="main-slider__swiper-button-next">
                        <i class="icon-chevron left"></i>
                    </div>
                    <div class="swiper-button-next" id="main-slider__swiper-button-prev">
                        <i class="icon-chevron right"></i>
                    </div>
                </div>

            </div>
        </section>
