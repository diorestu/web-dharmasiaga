@extends('layouts.finbank')
@php($title = $product['title'].' — KSP Dharma Siaga')
@section('content')
@include('partials.template-breadcrumb', ['pageTitle' => 'Produk Simpanan'])
<section class="savings-detail py-5">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <a class="text-dark text-decoration-underline" href="{{ route('pages.savings') }}">Semua produk simpanan</a>
                <div class="sec-title mt-4">
                    <h1 class="savings-detail-title">{{ $product['title'] }}</h1>
                    <div class="sub-title"><p>{{ $product['description'] }}</p></div>
                </div>
                <div class="text-dark">
                    @foreach($product['sections'] as $section)
                        <section class="mb-5" aria-labelledby="service-section-{{ $loop->iteration }}">
                            <h2 id="service-section-{{ $loop->iteration }}" class="h4 mb-4">{{ $section['title'] }}</h2>
                            <ul class="savings-detail-list">
                                @foreach($section['items'] as $item)
                                    <li class="mb-3">
                                        <strong>{{ $item['title'] }}</strong>
                                        @if($item['text'] !== '')<p class="mt-1 mb-0">{{ $item['text'] }}</p>@endif
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                    @endforeach
                    @if(isset($product['note']))<p class="mb-5"><strong>Catatan:</strong> {{ $product['note'] }}</p>@endif
                    <div class="savings-detail-cta pt-4">
                        <h2 class="h4 mb-3">Konsultasikan {{ $product['menu_title'] ?? $product['title'] }}</h2>
                        <p>Tanyakan persyaratan dan ketentuan layanan kepada tim KSP Dharma Siaga.</p>
                        <p class="mb-4">Kode referal layanan: <strong>{{ $product['referral_code'] }}</strong></p>
                        <a id="savings-whatsapp" class="btn-one" href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer"><span class="txt">Chat WhatsApp</span></a>
                        <p class="mt-3 mb-0">Nama layanan dan kode referal otomatis disertakan dalam pesan WhatsApp.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
