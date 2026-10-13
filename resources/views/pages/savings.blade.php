@extends('layouts.finbank')
@php($title = 'Simpanan — KSP Dharma Siaga')
@section('content')
@include('partials.template-breadcrumb', ['pageTitle' => 'Simpanan'])
<section class="faq-style1-area" id="savings-products"><div class="container">
    <div class="sec-title text-center"><h2>Pilihan Simpanan</h2><div class="sub-title"><p>Kenali manfaat, setoran, dan persyaratan setiap produk.</p></div></div>
    <div class="row"><div class="col-lg-10 offset-lg-1"><div class="faq-style1__content">
        <ul class="accordion-box">
        @foreach(config('cooperative.savings') as $product)
            <li id="{{ $product['id'] }}" class="accordion block {{ $loop->first ? 'active-block' : '' }}" data-product>
                <div class="acc-btn {{ $loop->first ? 'active' : '' }}" role="button" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="{{ $product['id'] }}-details"><div class="icon-outer"><i class="icon-right-arrow"></i></div><h3>{{ $product['title'] }}</h3></div>
                <div id="{{ $product['id'] }}-details" class="acc-content {{ $loop->first ? 'current' : '' }}"><div class="pb-4 text-dark">
                    <p class="mb-4">{{ $product['description'] }}</p>
                    @foreach($product['sections'] as $section)
                        <h4 class="mb-3">{{ $section['title'] }}</h4>
                        <ol class="ps-4 mb-4">@foreach($section['items'] as $item)<li class="mb-3"><strong><span aria-hidden="true">{{ $loop->iteration }}.</span> {{ $item['title'] }}</strong>@if($item['text'])<p>{{ $item['text'] }}</p>@endif</li>@endforeach</ol>
                    @endforeach
                    @if(isset($product['note']))<p class="mb-4"><strong>Catatan:</strong> {{ $product['note'] }}</p>@endif
                    <a class="text-dark text-decoration-underline" href="{{ route('home') }}#contact">Konsultasikan produk ini</a>
                </div></div>
            </li>
        @endforeach
        </ul>
    </div></div></div>
</div></section>
@endsection
