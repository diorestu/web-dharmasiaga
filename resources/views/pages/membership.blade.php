@extends('layouts.finbank')
@php($title = 'Membership — KSP Dharma Siaga')
@section('content')
<div class="product-header">
    <h1 class="sr-only">Membership</h1>
    <img class="d-block w-100 h-auto" src="{{ asset('assets/images/resources/membership-header.jpeg') }}?v={{ filemtime(public_path('assets/images/resources/membership-header.jpeg')) }}" alt="Membership KSP Dharma Siaga" width="1280" height="568" fetchpriority="high">
</div>
<section class="faq-style1-area product-page" id="membership-products">
    <div class="container">
        <div class="sec-title text-center">
            <h2>Program Membership Koperasi</h2>
            <div class="sub-title">
                <p>Perlindungan sosial ketenagakerjaan, kenyamanan masa depan keluarga, dan fasilitas permodalan prioritas bagi anggota.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="faq-style1__content">
                    <ul class="accordion-box">
                        @foreach(config('cooperative.memberships') as $member)
                            <li id="{{ $member['id'] }}" class="accordion block {{ $loop->first ? 'active-block' : '' }}" data-product>
                                <div class="acc-btn {{ $loop->first ? 'active' : '' }}" role="button" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="{{ $member['id'] }}-details">
                                    <div class="icon-outer"><i class="icon-right-arrow"></i></div>
                                    <h3>{{ $member['title'] }} <span class="badge bg-warning text-dark ms-2 fs-6 align-middle">{{ $member['badge'] }}</span></h3>
                                </div>
                                <div id="{{ $member['id'] }}-details" class="acc-content {{ $loop->first ? 'current' : '' }}">
                                    <div class="pb-4 text-dark">
                                        @if(isset($member['subtitle']))
                                            <p class="text-primary fw-bold mb-2">{{ $member['subtitle'] }}</p>
                                        @endif
                                        <p class="mb-4">{{ $member['description'] }}</p>

                                        @if(isset($member['requirements']))
                                            <h4 class="mb-3">PERSYARATAN :</h4>
                                            <ul class="ps-4 mb-4 list-unstyled">
                                                @foreach($member['requirements'] as $req)
                                                    <li class="mb-2 d-flex align-items-center">
                                                        <i class="icon-right-arrow text-primary me-2" aria-hidden="true"></i>
                                                        <span>{{ $req }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif

                                        @if(isset($member['benefit_groups']))
                                            <h4 class="mb-3">MANFAAT & PERLINDUNGAN UTAMA :</h4>
                                            @foreach($member['benefit_groups'] as $bg)
                                                <div class="mb-4 p-3 bg-light rounded border">
                                                    <h5 class="fw-bold mb-2 text-dark">{{ $bg['title'] }}</h5>
                                                    @if(isset($bg['description']))
                                                        <p class="mb-2 text-muted">{{ $bg['description'] }}</p>
                                                    @endif
                                                    <ul class="ps-3 mb-0 list-unstyled">
                                                        @foreach($bg['items'] as $item)
                                                            <li class="mb-1 d-flex align-items-start">
                                                                <span class="text-primary me-2 font-weight-bold">•</span>
                                                                <span>{{ $item }}</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endforeach
                                        @endif

                                        @if(isset($member['advantages']))
                                            <h4 class="mb-3">MANFAAT & KEUNGGULAN :</h4>
                                            <ul class="ps-4 mb-4 list-unstyled">
                                                @foreach($member['advantages'] as $adv)
                                                    <li class="mb-2 d-flex align-items-center">
                                                        <i class="icon-right-arrow text-primary me-2" aria-hidden="true"></i>
                                                        <strong>{{ $adv }}</strong>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif

                                        @if(isset($member['table']))
                                            @include('partials.product-rate-table', ['table' => $member['table']])
                                        @endif

                                        @if($member['id'] === 'membership-gold')
                                            <div class="mb-4">
                                                <h4 class="mb-3 text-start">Tabel Angsuran Fasilitas Pinjaman Membership Gold</h4>
                                                <a class="d-block" href="{{ asset('assets/images/resources/membership-gold-installments.jpeg') }}" target="_blank" rel="noopener noreferrer" aria-label="Perbesar tabel angsuran Membership Gold">
                                                    <img class="d-block w-100 h-auto" src="{{ asset('assets/images/resources/membership-gold-installments.jpeg') }}" alt="Tabel angsuran Membership Gold untuk plafon Rp 5.000.000 sampai Rp 20.000.000 dengan tenor 1 dan 2 tahun" width="1280" height="650" loading="lazy">
                                                </a>
                                                <p class="small mt-2 mb-0 text-start">Klik tabel untuk memperbesar.</p>
                                            </div>
                                        @endif

                                        @if(isset($member['payment_options']))
                                            <h4 class="mb-3">PILIHAN CARA PEMBAYARAN :</h4>
                                            <div class="row g-3 mb-4">
                                                @foreach($member['payment_options'] as $pay)
                                                    <div class="col-md-6">
                                                        <div class="p-3 border rounded h-100 bg-white shadow-sm">
                                                            <span class="badge bg-secondary mb-2">{{ $pay['type'] }}</span>
                                                            <p class="mb-0 text-dark text-start">{{ $pay['detail'] }}</p>
                                                            @if($member['id'] === 'membership-plus' && $pay['type'] === 'Cicilan / Kredit')
                                                                <a class="d-block mt-3" href="{{ asset('assets/images/resources/membership-plus-installments.jpeg') }}" target="_blank" rel="noopener noreferrer" aria-label="Perbesar tabel pinjaman Membership Plus">
                                                                    <img class="d-block w-100 h-auto" src="{{ asset('assets/images/resources/membership-plus-installments.jpeg') }}" alt="Tabel pinjaman Membership Plus dengan baki debet Rp 6.000.000 dan tenor 1 sampai 5 tahun" width="1600" height="400" loading="lazy">
                                                                </a>
                                                                <p class="small mt-2 mb-0 text-start">Klik tabel untuk memperbesar.</p>
                                                            @endif
                                                            @if(isset($pay['installments']))
                                                                <div class="sr-only">
                                                                    <h5 class="p-3 mb-0 text-white text-start" style="background-color: #007a3d;">TABEL PINJAMAN MEMBERSHIP PLUS</h5>
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered align-middle text-center mb-0">
                                                                            <thead style="background-color: #007a3d; color: #ffffff;">
                                                                                <tr><th scope="col">BAKI DEBET</th><th scope="col">TENOR PINJAMAN</th><th scope="col">ANGSURAN PER BULAN</th></tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach($pay['installments'] as $installment)
                                                                                    <tr>
                                                                                        @if($loop->first)
                                                                                            <th scope="rowgroup" rowspan="{{ count($pay['installments']) }}" style="background-color: #fff8dc; color: #0b5834;">Rp 6.000.000,-<br><small class="fw-normal">Baki Debet Tetap</small></th>
                                                                                        @endif
                                                                                        <th scope="row">{{ $installment[0] }}</th>
                                                                                        <td class="fw-bold text-nowrap">{{ $installment[1] }}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif

                                        <div class="pt-3 border-top mt-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                                            <div>
                                                <p class="mb-0 text-muted small">Kode referal layanan: <strong>{{ $member['referral_code'] }}</strong></p>
                                            </div>
                                            <div>
                                                @php($waMsg = "Halo KSP Dharma Siaga, saya berminat mendaftar {$member['title']}. Kode referal layanan: {$member['referral_code']}.")
                                                @php($waLink = 'https://wa.me/'.config('cooperative.office.whatsapp_number').'?text='.rawurlencode($waMsg))
                                                <a class="btn-one" href="{{ $waLink }}" target="_blank" rel="noopener noreferrer">
                                                    <span class="txt"><i class="fab fa-whatsapp"></i>Daftar / Konsultasi WhatsApp</span>
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
