@extends('layouts.finbank')
@php($title = 'Pinjaman — KSP Dharma Siaga')
@section('content')
@include('partials.template-breadcrumb', ['pageTitle' => 'Pinjaman'])
<section class="faq-style1-area product-page" id="loan-products">
    <div class="container">
        <div class="sec-title text-center">
            <h2>Layanan Pinjaman Koperasi</h2>
            <div class="sub-title">
                <p>Solusi permodalan produktif, multiguna, dan usaha dengan proses cepat, transparan, dan bunga bersahabat.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="faq-style1__content">
                    <ul class="accordion-box">
                        @foreach(config('cooperative.loans') as $loan)
                            <li id="{{ $loan['id'] }}" class="accordion block {{ $loop->first ? 'active-block' : '' }}" data-product>
                                <div class="acc-btn {{ $loop->first ? 'active' : '' }}" role="button" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="{{ $loan['id'] }}-details">
                                    <div class="icon-outer"><i class="icon-right-arrow"></i></div>
                                    <h3>{{ $loan['title'] }} <span class="badge bg-primary text-white ms-2 fs-6 align-middle">{{ $loan['badge'] }}</span></h3>
                                </div>
                                <div id="{{ $loan['id'] }}-details" class="acc-content {{ $loop->first ? 'current' : '' }}">
                                    <div class="pb-4 text-dark">
                                        <p class="mb-4">{{ $loan['description'] }}</p>

                                        @if(isset($loan['requirements']))
                                            <h4 class="mb-3">SYARAT PINJAMAN :</h4>
                                            <ol class="ps-4 mb-4">
                                                @foreach($loan['requirements'] as $req)
                                                    <li class="mb-2"><strong><span aria-hidden="true">{{ $loop->iteration }}.</span> {{ $req }}</strong></li>
                                                @endforeach
                                            </ol>
                                        @endif

                                        @if(isset($loan['advantages']))
                                            <h4 class="mb-3">KEUNGGULAN :</h4>
                                            <ul class="ps-4 mb-4 list-unstyled">
                                                @foreach($loan['advantages'] as $adv)
                                                    <li class="mb-3 d-flex align-items-start">
                                                        <i class="icon-right-arrow text-primary me-2 mt-1" aria-hidden="true"></i>
                                                        <div>
                                                            <strong>{{ $adv['title'] }}</strong>
                                                            @if($adv['text'] !== '')<p class="mb-0 text-muted">{{ $adv['text'] }}</p>@endif
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif

                                        @if(isset($loan['table']))
                                            <div class="loan-installment-table mb-4">
                                                @if(isset($loan['table']['title']))
                                                    <h4 class="mb-3">{{ $loan['table']['title'] }}</h4>
                                                @endif
                                                <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden; border: 1px solid #198754 !important;">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered mb-0 align-middle text-center" style="border-color: #c3e6cb;">
                                                            <thead style="background-color: {{ $loan['table']['header_bg'] ?? '#0d7a46' }}; color: #ffffff;">
                                                                <tr>
                                                                    <th rowspan="2" class="align-middle py-3 px-3 fw-bold fs-6" style="border-color: rgba(255,255,255,0.3); vertical-align: middle;">PINJAMAN</th>
                                                                    <th colspan="{{ count($loan['table']['tenors']) }}" class="py-2 px-3 fw-bold fs-6" style="border-color: rgba(255,255,255,0.3);">JUMLAH ANGSURAN</th>
                                                                </tr>
                                                                <tr>
                                                                    @foreach($loan['table']['tenors'] as $tenor)
                                                                        <th class="py-2 px-2 fw-bold" style="border-color: rgba(255,255,255,0.3); font-size: 0.95rem;">{{ $tenor }}</th>
                                                                    @endforeach
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($loan['table']['rows'] as $row)
                                                                    <tr style="background-color: {{ $loop->iteration % 2 === 0 ? '#e8f7f0' : '#ffffff' }}; font-weight: {{ $loop->last ? '700' : '600' }};">
                                                                        <td class="py-2 px-3 fw-bold" style="color: #0b4d2c; border-color: #c3e6cb;">{{ $row['principal'] }}</td>
                                                                        @foreach($row['installments'] as $inst)
                                                                            <td class="py-2 px-2" style="color: {{ $inst === '-' ? '#6c757d' : '#212529' }}; border-color: #c3e6cb;">{{ $inst }}</td>
                                                                        @endforeach
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="pt-3 border-top mt-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                                            <div>
                                                <p class="mb-0 text-muted small">Kode referal layanan: <strong>{{ $loan['referral_code'] }}</strong></p>
                                            </div>
                                            <div class="d-flex flex-wrap gap-2">
                                                @php($waMsg = "Halo KSP Dharma Siaga, saya ingin konsultasi mengenai {$loan['title']}. Kode referal layanan: {$loan['referral_code']}.")
                                                @php($waLink = 'https://wa.me/'.config('cooperative.office.whatsapp_number').'?text='.rawurlencode($waMsg))
                                                <a class="btn-one" href="{{ route('loan-applications.create') }}">
                                                    <span class="txt"><i class="fas fa-file-signature me-1"></i>Formulir Pengajuan</span>
                                                </a>
                                                <a class="btn-one" href="{{ $waLink }}" target="_blank" rel="noopener noreferrer">
                                                    <span class="txt"><i class="fab fa-whatsapp"></i>Ajukan Lewat WhatsApp</span>
                                                </a>
                                                <a class="btn-one" href="{{ route('home') }}#loan-simulation">
                                                    <span class="txt">Simulasi Pinjaman</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection