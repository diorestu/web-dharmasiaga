<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'KSP Dharma Siaga — Koperasi Simpan Pinjam' }}</title>
    <!-- Favicons Icons -->
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicons/favicon-32x32.png') }}" />
<link rel="manifest" href="{{ asset('assets/images/favicons/site.webmanifest') }}" />
    <meta name="description" content="{{ $content['meta_description'] ?? 'Simpanan, pinjaman, dan informasi keanggotaan KSP Dharma Siaga di Denpasar, Bali.' }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title ?? 'KSP Dharma Siaga' }}">
    <meta property="og:description" content="{{ $content['meta_description'] ?? 'Simpanan, pinjaman, dan informasi keanggotaan KSP Dharma Siaga di Denpasar, Bali.' }}">
    <meta property="og:image" content="{{ asset('images/ksp-dharma-siaga-logo.jpeg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="icon" href="{{ asset('images/ksp-dharma-siaga-logo.jpeg') }}">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/vendors/animate/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/animate/custom-animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/bxslider/jquery.bxslider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-ui/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/nice-select/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/odometer/odometer.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/swiper/swiper.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/vegas/vegas.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/thm-icons/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/language-switcher/polyglot-language-switcher.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/aos/aos.css') }}">
    <!-- Module css -->
    <link rel="stylesheet" href="{{ asset('assets/css/module-css/01-header-section.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/module-css/02-banner-section.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/module-css/03-about-section.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/module-css/04-fact-counter-section.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/module-css/05-testimonial-section.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/module-css/06-partner-section.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/module-css/07-footer-section.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/module-css/08-blog-section.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/module-css/09-breadcrumb-section.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/module-css/10-contact.css') }}">
    <!-- Template styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" />

</head>
<body>

<div class="page-wrapper">
@include("partials.template-header")
<main id="main-content">@yield("content")</main>
@include("partials.template-footer")
</div>
<div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler">
                <i class="fas fa-plus"></i>
            </span>
            <div class="logo-box">
                <a href="{{ route('home') }}" aria-label="logo image">
                    <img src="{{ asset('images/dharma-siaga-logo-light.svg') }}" alt="" />
                </a>
            </div>
            <div class="mobile-nav__container"></div>
            <ul class="mobile-nav__contact list-unstyled"><li><i class="fa fa-envelope"></i><a href="{{ route('home') }}#contact">Hubungi layanan anggota</a></li></ul>
            
        </div>
    </div>


    <div class="search-popup">
        <div class="search-popup__overlay search-toggler"></div>
        <div class="search-popup__content">
            <form action="{{ route('home') }}#service" data-site-search>
                <label for="search" class="sr-only">Cari informasi</label>
                <input name="q" type="search" id="search" placeholder="Cari layanan atau informasi..." />
                <button type="submit" aria-label="Cari" class="thm-btn">
                    <i class="icon-search"></i>
                </button>
            </form>
        </div>
    </div>


    <a href="#" data-target="html" class="scroll-to-target scroll-to-top">
        <i class="icon-chevron"></i>
    </a>



<script src="{{ asset('assets/vendors/jquery/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bxslider/jquery.bxslider.min.js') }}"></script>
<script src="{{ asset('assets/vendors/circleType/jquery.circleType.js') }}"></script>
<script src="{{ asset('assets/vendors/circleType/jquery.lettering.min.js') }}"></script>
<script src="{{ asset('assets/vendors/isotope/isotope.js') }}"></script>
<script src="{{ asset('assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jquery-appear/jquery.appear.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jquery-migrate/jquery-migrate.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jquery-ui/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/vendors/jquery-validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/vendors/nice-select/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('assets/vendors/odometer/odometer.min.js') }}"></script>
<script src="{{ asset('assets/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/vendors/swiper/swiper.min.js') }}"></script>
<script src="{{ asset('assets/vendors/vegas/vegas.min.js') }}"></script>
<script src="{{ asset('assets/vendors/wnumb/wNumb.min.js') }}"></script>
<script src="{{ asset('assets/vendors/wow/wow.js') }}"></script>
<script src="{{ asset('assets/vendors/extra-scripts/jquery.paroller.min.js') }}"></script>
<script src="{{ asset('assets/vendors/language-switcher/jquery.polyglot.language.switcher.js') }}"></script>
<script src="{{ asset('assets/vendors/aos/aos.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/dharma-siaga.js') }}"></script>
</body>
</html>
