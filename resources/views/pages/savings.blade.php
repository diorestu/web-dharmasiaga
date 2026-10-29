@extends('layouts.finbank')
@php($title = 'Simpanan — KSP Dharma Siaga')
@section('content')
@include('partials.template-breadcrumb', ['pageTitle' => 'Simpanan'])
<section class="faq-style1-area product-page" id="savings-products"><div class="container">
    <div class="sec-title text-center"><h2>Pilihan Simpanan</h2><div class="sub-title"><p>Kenali manfaat, setoran, dan persyaratan setiap produk.</p></div></div>
    <div class="row"><div class="col-lg-10 offset-lg-1"><div class="faq-style1__content">
        <ul class="accordion-box">
        @foreach(config('cooperative.savings') as $product)
            <li id="{{ $product['id'] }}" class="accordion block {{ $loop->first ? 'active-block' : '' }}" data-product>
                <div class="acc-btn {{ $loop->first ? 'active' : '' }}" role="button" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="{{ $product['id'] }}-details"><div class="icon-outer"><i class="icon-right-arrow"></i></div><h3>{{ $product['title'] }}</h3></div>
                <div id="{{ $product['id'] }}-details" class="acc-content {{ $loop->first ? 'current' : '' }}"><div class="pb-4 text-dark">
                    <p class="mb-4">{{ $product['description'] }}</p>
                    @if(isset($product['table']))
                        <div class="savings-rate-table mb-4">
                            @if(isset($product['table']['title']))
                                <h4 class="mb-3">{{ $product['table']['title'] }}</h4>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center bg-white shadow-sm" style="border-radius: 8px; overflow: hidden; border-color: {{ $product['table']['border_color'] ?? '#dee2e6' }};">
                                    <thead style="background-color: {{ $product['table']['header_bg'] ?? '#f8f9fa' }}; color: {{ isset($product['table']['header_bg']) ? '#ffffff' : '#212529' }};">
                                        <tr>
                                            @foreach($product['table']['headers'] as $header)
                                                <th scope="col" class="{{ !isset($product['table']['rowspan_col_0']) && $loop->first ? 'text-start ps-3' : 'text-center' }} py-2" style="font-weight: 700;">{{ $header }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($product['table']['rows'] as $rowIndex => $row)
                                            <tr>
                                                @if(!empty($product['table']['rowspan_col_0']))
                                                    @if($rowIndex === 0)
                                                        <td rowspan="{{ count($product['table']['rows']) }}" class="align-middle fw-bold py-2 text-center fs-5" style="color: #212529; border-color: {{ $product['table']['border_color'] ?? '#dee2e6' }};">
                                                            {{ $row[0] }}
                                                        </td>
                                                    @endif
                                                    <td class="align-middle fw-bold py-2 text-center" style="color: #212529; border-color: {{ $product['table']['border_color'] ?? '#dee2e6' }};">{{ $row[1] }}</td>
                                                    <td class="align-middle fw-bold py-2 text-center" style="color: #212529; border-color: {{ $product['table']['border_color'] ?? '#dee2e6' }};">{{ $row[2] }}</td>
                                                @else
                                                    @foreach($row as $cell)
                                                        <td class="{{ $loop->first ? 'text-start ps-3' : 'text-center' }} fw-bold py-2" style="color: #212529;">{{ $cell }}</td>
                                                    @endforeach
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                    @foreach($product['sections'] as $section)
                        <h4 class="mb-3">{{ $section['title'] }}</h4>
                        <ol class="ps-4 mb-4">@foreach($section['items'] as $item)<li class="mb-3"><strong><span aria-hidden="true">{{ $loop->iteration }}.</span> {{ $item['title'] }}</strong>@if($item['text'])<p>{{ $item['text'] }}</p>@endif</li>@endforeach</ol>
                    @endforeach
                    @if(isset($product['note']))<p class="mb-4"><strong>Catatan:</strong> {{ $product['note'] }}</p>@endif
                    <div class="d-flex flex-wrap align-items-center gap-2 pt-3 border-top mt-4">
                        @php($waMsg = "Halo KSP Dharma Siaga, saya ingin konsultasi mengenai {$product['title']}. Kode referal layanan: {$product['referral_code']}.")
                        @php($waLink = 'https://wa.me/'.config('cooperative.office.whatsapp_number').'?text='.rawurlencode($waMsg))
                        <a class="btn-one" href="{{ $waLink }}" target="_blank" rel="noopener noreferrer">
                            <span class="txt"><i class="fab fa-whatsapp"></i>Konsultasi WhatsApp</span>
                        </a>
                        <a class="btn-one" href="{{ route('pages.savings.show', $product['id']) }}">
                            <span class="txt">Detail Layanan</span>
                        </a>
                    </div>
                </div></div>
            </li>
        @endforeach
        </ul>
    </div></div></div>
</div></section>
@endsection
