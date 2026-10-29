@extends('layouts.finbank')
@php($title = $product['title'].' — KSP Dharma Siaga')
@section('content')
@include('partials.template-breadcrumb', ['pageTitle' => 'Produk Simpanan', 'secondaryHeading' => true])
<section class="savings-detail product-page py-5">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <a class="text-dark text-decoration-underline" href="{{ route('pages.savings') }}">Semua produk simpanan</a>
                <div class="sec-title mt-4">
                    <h1 class="savings-detail-title">{{ $product['title'] }}</h1>
                    <div class="sub-title"><p>{{ $product['description'] }}</p></div>
                </div>
                <div class="text-dark">
                    @if(isset($product['table']))
                        <div class="savings-rate-table mb-5">
                            @if(isset($product['table']['title']))
                                <h2 class="h4 mb-3">{{ $product['table']['title'] }}</h2>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center bg-white shadow-sm" style="border-radius: 8px; overflow: hidden; border-color: {{ $product['table']['border_color'] ?? '#dee2e6' }};">
                                    <thead style="background-color: {{ $product['table']['header_bg'] ?? '#f8f9fa' }}; color: {{ isset($product['table']['header_bg']) ? '#ffffff' : '#212529' }};">
                                        <tr>
                                            @foreach($product['table']['headers'] as $header)
                                                <th scope="col" class="{{ !isset($product['table']['rowspan_col_0']) && $loop->first ? 'text-start ps-3' : 'text-center' }} py-3" style="font-weight: 700;">{{ $header }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($product['table']['rows'] as $rowIndex => $row)
                                            <tr>
                                                @if(!empty($product['table']['rowspan_col_0']))
                                                    @if($rowIndex === 0)
                                                        <td rowspan="{{ count($product['table']['rows']) }}" class="align-middle fw-bold py-3 text-center fs-5" style="color: #212529; border-color: {{ $product['table']['border_color'] ?? '#dee2e6' }};">
                                                            {{ $row[0] }}
                                                        </td>
                                                    @endif
                                                    <td class="align-middle fw-bold py-3 text-center" style="color: #212529; border-color: {{ $product['table']['border_color'] ?? '#dee2e6' }};">{{ $row[1] }}</td>
                                                    <td class="align-middle fw-bold py-3 text-center" style="color: #212529; border-color: {{ $product['table']['border_color'] ?? '#dee2e6' }};">{{ $row[2] }}</td>
                                                @else
                                                    @foreach($row as $cell)
                                                        <td class="{{ $loop->first ? 'text-start ps-3' : 'text-center' }} fw-bold py-3" style="color: #212529;">{{ $cell }}</td>
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
                        <a id="savings-whatsapp" class="btn-one" href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer"><span class="txt"><i class="fab fa-whatsapp"></i>Chat WhatsApp</span></a>
                        <p class="mt-3 mb-0">Nama layanan dan kode referal otomatis disertakan dalam pesan WhatsApp.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
