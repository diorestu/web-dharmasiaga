@extends('layouts.finbank')
@php($title = 'Pengajuan Pinjaman Berhasil — KSP Dharma Siaga')
@section('content')
@include('partials.template-breadcrumb', ['pageTitle' => 'Status Pengajuan Pinjaman'])

<section class="loan-success-section py-5 bg-light product-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card border-0 shadow-sm text-center p-4 p-md-5 mb-4" style="border-radius: 16px;">
                    <div class="mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 80px; height: 80px; background-color: #e8f5e9; color: #28a745;">
                            <i class="fas fa-check-circle fa-3x"></i>
                        </div>
                    </div>

                    <h1 class="h3 fw-bold text-dark mb-2">Permohonan Pinjaman Berhasil Dikirim!</h1>
                    <p class="text-muted mb-4">Terima kasih telah mengajukan permohonan kredit di KSP Dharma Siaga. Formulir Anda telah tersimpan dalam sistem kami.</p>

                    <!-- Reference Number Box -->
                    <div class="p-3 mb-4 rounded-3 text-center" style="background-color: #f1f8fc; border: 2px dashed #164b78;">
                        <span class="text-muted small text-uppercase fw-semibold d-block">Nomor Referensi Pengajuan:</span>
                        <span class="fs-3 fw-bold text-primary tracking-wide">{{ $application->reference_number }}</span>
                        <small class="text-muted d-block mt-1">Harap simpan atau screenshot nomor ini untuk kemudahan pelacakan.</small>
                    </div>

                    <!-- Details Summary Card -->
                    <div class="text-start bg-light p-3 p-md-4 rounded-3 mb-4 border">
                        <h2 class="h6 fw-bold text-dark mb-3 border-bottom pb-2">Ringkasan Data Pengajuan:</h2>
                        <div class="row g-2 small">
                            <div class="col-sm-6"><span class="text-muted">Nama Peminjam:</span> <strong class="d-block text-dark">{{ $application->name }}</strong></div>
                            <div class="col-sm-6"><span class="text-muted">No. Telepon / WhatsApp:</span> <strong class="d-block text-dark">{{ $application->phone }}</strong></div>
                            <div class="col-sm-6"><span class="text-muted">Jumlah Pinjaman:</span> <strong class="d-block text-primary fs-6">{{ $application->formatted_loan_amount }}</strong></div>
                            <div class="col-sm-6"><span class="text-muted">Jangka Waktu:</span> <strong class="d-block text-dark">{{ $application->loan_term_months }} Bulan</strong></div>
                            <div class="col-sm-6"><span class="text-muted">Jenis Agunan:</span> <strong class="d-block text-dark">{{ $application->collateral_type }}</strong></div>
                            <div class="col-sm-6"><span class="text-muted">Skema Pembayaran:</span> <strong class="d-block text-dark">{{ $application->payment_scheme }}</strong></div>
                            <div class="col-12 mt-2 pt-2 border-top"><span class="text-muted">Status Saat Ini:</span> <span class="badge bg-warning text-dark px-2 py-1 ms-1">{{ $application->status_label }}</span></div>
                        </div>
                    </div>

                    <!-- Steps Timeline -->
                    <div class="text-start mb-4">
                        <h3 class="h6 fw-bold text-dark mb-3">Langkah Selanjutnya:</h3>
                        <div class="d-flex flex-column gap-3 small">
                            <div class="d-flex align-items-start gap-3">
                                <span class="badge rounded-circle bg-success text-white p-2" style="width: 24px; height: 24px; display: inline-flex; align-items: center; justify-content: center;">1</span>
                                <div>
                                    <strong>Verifikasi Administrasi (1x24 Jam Kerja)</strong>
                                    <p class="text-muted mb-0">Tim analis kredit akan memverifikasi kelengkapan berkas dan data yang Anda kirimkan.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start gap-3">
                                <span class="badge rounded-circle bg-secondary text-white p-2" style="width: 24px; height: 24px; display: inline-flex; align-items: center; justify-content: center;">2</span>
                                <div>
                                    <strong>Konfirmasi Jadwal Survei</strong>
                                    <p class="text-muted mb-0">Petugas KSP Dharma Siaga akan menghubungi Anda via WhatsApp atau telepon untuk penjadwalan survei lokasi dan cek fisik jaminan.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start gap-3">
                                <span class="badge rounded-circle bg-secondary text-white p-2" style="width: 24px; height: 24px; display: inline-flex; align-items: center; justify-content: center;">3</span>
                                <div>
                                    <strong>Persetujuan Komite & Pencairan</strong>
                                    <p class="text-muted mb-0">Setelah survei dinyatakan layak, Anda diundang ke kantor KSP Dharma Siaga untuk penandatanganan akad pinjaman dan pencairan dana.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    @php($waMessage = "Halo KSP Dharma Siaga, saya telah mengajukan pinjaman secara online dengan Nomor Referensi: {$application->reference_number} atas nama {$application->name}. Mohon informasi tindak lanjutnya. Terima kasih.")
                    @php($waUrl = 'https://wa.me/'.config('cooperative.office.whatsapp_number').'?text='.rawurlencode($waMessage))

                    <div class="d-flex flex-wrap gap-2 justify-content-center pt-2">
                        <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer" class="btn btn-success px-4 py-2 fw-semibold" style="border-radius: 8px;">
                            <i class="fab fa-whatsapp me-2"></i> Konfirmasi ke Petugas WhatsApp
                        </a>
                        <button onclick="window.print()" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 8px;">
                            <i class="fas fa-print me-2"></i> Cetak Bukti Pengajuan
                        </button>
                        <a href="{{ route('home') }}" class="btn btn-light px-4 py-2 border" style="border-radius: 8px;">
                            <i class="fas fa-home me-2"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
