<section class="breadcrumb-area">
    <div class="breadcrumb-area-bg" style="background-image: url({{ asset($bgImage ?? 'assets/images/resources/dharma-office-front.jpeg') }});"></div>
    <div class="container"><div class="row"><div class="col-xl-12"><div class="inner-content">
        <div class="title" data-aos="fade-right" data-aos-easing="linear" data-aos-duration="500">@if($secondaryHeading ?? false)<h2>{{ $pageTitle }}</h2>@else<h1>{{ $pageTitle }}</h1>@endif</div>
        <div class="breadcrumb-menu" data-aos="fade-left" data-aos-easing="linear" data-aos-duration="500"><ul><li><a href="{{ route('home') }}">Beranda</a></li><li class="active">{{ $pageTitle }}</li></ul></div>
    </div></div></div></div>
</section>
