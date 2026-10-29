@extends('layouts.finbank')
@php($title = 'Membership — KSP Dharma Siaga')
@section('content')
@include('partials.template-breadcrumb', ['pageTitle' => 'Membership'])
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
                                            <div class="membership-loan-table mb-4">
                                                <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden; border: 1px solid {{ $member['table']['border_color'] ?? '#d0d7de' }} !important;">
                                                    <div class="text-center py-3 text-white fw-bold" style="background-color: {{ $member['table']['header_bg'] ?? '#0b3b7a' }}; font-size: 1.15rem; letter-spacing: 0.5px;">
                                                        {{ $member['table']['title'] }}
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered mb-0 align-middle text-center bg-white" style="border-color: {{ $member['table']['border_color'] ?? '#dee2e6' }};">
                                                            <thead style="background-color: {{ $member['table']['thead_bg'] ?? '#f8f9fa' }}; color: {{ isset($member['table']['thead_bg']) ? '#ffffff' : '#212529' }};">
                                                                <tr>
                                                                    @foreach($member['table']['headers'] as $header)
                                                                        <th scope="col" class="py-3 fw-bold" style="border-color: {{ $member['table']['border_color'] ?? '#dee2e6' }};">{{ $header }}</th>
                                                                    @endforeach
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($member['table']['rows'] as $row)
                                                                    <tr style="background-color: {{ $loop->iteration % 2 === 0 ? '#fdf8f8' : '#ffffff' }};">
                                                                        @foreach($row as $cell)
                                                                            <td class="py-2 fw-bold" style="color: #212529; border-color: {{ $member['table']['border_color'] ?? '#dee2e6' }};">{{ $cell }}</td>
                                                                        @endforeach
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if(isset($member['payment_options']))
                                            <h4 class="mb-3">PILIHAN CARA PEMBAYARAN :</h4>
                                            <div class="row g-3 mb-4">
                                                @foreach($member['payment_options'] as $pay)
                                                    <div class="col-md-6">
                                                        <div class="p-3 border rounded h-100 bg-white shadow-sm">
                                                            <span class="badge bg-secondary mb-2">{{ $pay['type'] }}</span>
                                                            <p class="mb-0 text-dark">{{ $pay['detail'] }}</p>
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