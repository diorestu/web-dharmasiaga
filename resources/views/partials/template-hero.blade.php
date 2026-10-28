<section id="home" class="main-slider main-slider-style1">
    <div class="sr-only">
        <h1 data-copy-id="{{ $content['hero_title_id'] ?? 'Tumbuh bersama,|untuk masa depan|yang lebih baik.' }}" data-copy-en="{{ $content['hero_title_en'] ?? 'Grow together,|for a better|tomorrow.' }}">
            @if(!empty($content['hero_title_id'])){{ $content['hero_title_id'] }}@else Tumbuh bersama,<br> untuk masa depan<br> yang lebih baik.@endif
        </h1>
        <p>KSP Dharma Siaga mendampingi kebutuhan simpanan dan pinjaman anggota di Denpasar, Bali.</p>
    </div>

    <div class="swiper-container thm-swiper__slider" data-swiper-options='{
        "slidesPerView": 1,
        "loop": true,
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
        }
    }'>
        <div class="swiper-wrapper">
            <!-- Slide 1: HUT ke-23 -->
            <div class="swiper-slide">
                <a href="{{ route('home') }}#service" class="slider-full-link" aria-label="23 Tahun KSP Dharma Siaga - Bersama Anggota, Menuju Sejahtera">
                    <div class="image-layer" style="background-image: url({{ asset('assets/images/slides/header-slide-1.png') }});"></div>
                </a>
            </div>

            <!-- Slide 2: Gebyar Simpanan Berhadiah -->
            <div class="swiper-slide">
                <a href="{{ route('pages.savings') }}" class="slider-full-link" aria-label="Gebyar Simpanan Berhadiah Periode XII KSP Dharma Siaga">
                    <div class="image-layer" style="background-image: url({{ asset('assets/images/slides/header-slide-2.jpg') }});"></div>
                </a>
            </div>

            <!-- Slide 3: Pinjaman Modal Usaha -->
            <div class="swiper-slide">
                <a href="{{ route('home') }}#calculator" class="slider-full-link" aria-label="Pinjaman Modal Usaha KSP Dharma Siaga Bunga Mulai 1% per Bulan">
                    <div class="image-layer" style="background-image: url({{ asset('assets/images/slides/header-slide-3.jpg') }});"></div>
                </a>
            </div>

            <!-- Slide 4: Informasi Official -->
            <div class="swiper-slide">
                <a href="{{ route('home') }}#contact" class="slider-full-link" aria-label="Informasi Official KSP Dharma Siaga - WhatsApp dan Call Center">
                    <div class="image-layer" style="background-image: url({{ asset('assets/images/slides/header-slide-4.jpg') }});"></div>
                </a>
            </div>

            <!-- Slide 5: Membership Plus (+) -->
            <div class="swiper-slide">
                <a href="{{ route('pages.savings') }}" class="slider-full-link" aria-label="Membership Plus KSP Dharma Siaga - Perlindungan Hari Tua dan BPJS Ketenagakerjaan">
                    <div class="image-layer" style="background-image: url({{ asset('assets/images/slides/header-slide-5.jpg') }});"></div>
                </a>
            </div>

            <!-- Slide 6: Waspada Penipuan -->
            <div class="swiper-slide">
                <a href="{{ route('pages.branches') }}" class="slider-full-link" aria-label="Perhatian Waspada Penipuan KSP Dharma Siaga">
                    <div class="image-layer" style="background-image: url({{ asset('assets/images/slides/header-slide-6.jpg') }});"></div>
                </a>
            </div>
        </div>

        <!-- Pagination Bullets -->
        <div class="swiper-pagination" id="main-slider-pagination"></div>

        <!-- Navigation Buttons -->
        <div class="main-slider__nav">
            <div class="swiper-button-prev" id="main-slider__swiper-button-prev" aria-label="Slide sebelumnya">
                <i class="icon-chevron left"></i>
            </div>
            <div class="swiper-button-next" id="main-slider__swiper-button-next" aria-label="Slide berikutnya">
                <i class="icon-chevron right"></i>
            </div>
        </div>
    </div>
</section>
