@extends('layouts.admin')
@php($title = 'Detail Pengajuan #' . $application->reference_number)

@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <a href="{{ route('admin.loan-applications.index') }}" class="btn btn-outline-secondary btn-sm mb-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>
        <h1 class="h3 fw-bold text-dark mb-1">
            Pengajuan Pinjaman #{{ $application->reference_number }}
        </h1>
        <p class="text-muted small mb-0">
            Diterima sistem pada {{ $application->created_at ? $application->created_at->translatedFormat('d F Y, H:i') : '-' }} WITA
        </p>
    </div>

    <div class="d-flex flex-wrap gap-2">
        <a href="{{ $application->applicant_whatsapp_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-success btn-sm px-3">
            <i class="fab fa-whatsapp me-1"></i> Chat Pemohon
        </a>
        <a href="{{ route('admin.loan-applications.print', $application) }}" target="_blank" class="btn btn-outline-dark btn-sm px-3">
            <i class="fas fa-print me-1"></i> Cetak Formulir
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Main Left Column: Applicant Data Breakdown (PDF Sections A - D) -->
    <div class="col-lg-8">

        <!-- A. DATA PEMINJAM -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge rounded-circle p-2 text-white" style="background-color: #164b78; width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center;">A</span>
                    <h2 class="h5 mb-0 fw-bold text-dark">DATA PEMINJAM</h2>
                </div>
                <span class="badge {{ $application->status_badge_class }} px-3 py-1">
                    {{ $application->status_label }}
                </span>
            </div>
            <div class="card-body p-4">
                <div class="row g-3 small">
                    <div class="col-md-6">
                        <span class="text-muted d-block">1. Nama Lengkap:</span>
                        <strong class="fs-6 text-dark">{{ $application->name }}</strong>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted d-block">2. Pekerjaan / Usaha:</span>
                        <strong class="text-dark">{{ $application->occupation === 'dll' ? $application->occupation_other : $application->occupation }}</strong>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted d-block">3. Alamat Sekarang (Domisili):</span>
                        <span class="text-dark">{{ $application->current_address }}</span>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted d-block">4. Alamat Asal:</span>
                        <span class="text-dark">{{ $application->origin_address }}</span>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted d-block">5. Alamat Korespondensi:</span>
                        <span class="text-dark">{{ $application->correspondence_address ?: 'Sama dengan alamat sekarang' }}</span>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted d-block">6. No. Telp / WhatsApp:</span>
                        <strong class="text-primary">{{ $application->phone }}</strong>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted d-block">7. Jumlah Pinjaman:</span>
                        <strong class="fs-5 text-success">{{ $application->formatted_loan_amount }}</strong>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted d-block">8. Tujuan Pinjaman:</span>
                        <strong class="text-dark">{{ $application->loan_purpose }}</strong>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted d-block">9. Jangka Waktu / Tenor:</span>
                        <strong class="text-dark">{{ $application->loan_term_months }} Bulan</strong>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted d-block">10. Agunan Pinjaman:</span>
                        <strong class="text-dark">{{ $application->collateral_type }}</strong>
                        @if($application->collateral_description)
                            <span class="text-muted d-block small">Ket: {{ $application->collateral_description }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted d-block">11. Skema Pembayaran:</span>
                        <strong class="text-dark">{{ $application->payment_scheme }}</strong>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted d-block">12. Nama Ibu Kandung:</span>
                        <strong class="text-dark">{{ $application->mother_maiden_name }}</strong>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted d-block">13. Tanggal Pengajuan:</span>
                        <span class="text-dark">{{ $application->application_date ? $application->application_date->translatedFormat('d F Y') : '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- B. PENANGGUNG JAWAB -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                <span class="badge rounded-circle p-2 text-white" style="background-color: #164b78; width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center;">B</span>
                <h2 class="h5 mb-0 fw-bold text-dark">PENANGGUNG JAWAB</h2>
            </div>
            <div class="card-body p-4">
                <div class="row g-3 small">
                    <div class="col-md-6">
                        <span class="text-muted d-block">14. Nama Penanggung Jawab:</span>
                        <strong class="text-dark">{{ $application->guarantor_name }}</strong>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted d-block">Hubungan Dengan Peminjam:</span>
                        <strong class="text-dark">{{ $application->guarantor_relationship ?: '-' }}</strong>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted d-block">15. Pekerjaan:</span>
                        <span class="text-dark">{{ $application->guarantor_occupation ?: '-' }}</span>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted d-block">18. No. Telp / HP:</span>
                        <span class="text-dark">{{ $application->guarantor_phone ?: '-' }}</span>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted d-block">16. Alamat Sekarang:</span>
                        <span class="text-dark">{{ $application->guarantor_current_address ?: '-' }}</span>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted d-block">17. Alamat Asal:</span>
                        <span class="text-dark">{{ $application->guarantor_origin_address ?: '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- C. AHLI WARIS -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                <span class="badge rounded-circle p-2 text-white" style="background-color: #164b78; width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center;">C</span>
                <h2 class="h5 mb-0 fw-bold text-dark">AHLI WARIS</h2>
            </div>
            <div class="card-body p-4">
                <div class="row g-3 small">
                    <div class="col-md-6">
                        <span class="text-muted d-block">20. Nama Ahli Waris:</span>
                        <strong class="text-dark">{{ $application->heir_name }}</strong>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted d-block">Hubungan Dengan Peminjam:</span>
                        <strong class="text-dark">{{ $application->heir_relationship ?: '-' }}</strong>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted d-block">21. Pekerjaan:</span>
                        <span class="text-dark">{{ $application->heir_occupation ?: '-' }}</span>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted d-block">24. No. Telp / HP:</span>
                        <span class="text-dark">{{ $application->heir_phone ?: '-' }}</span>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted d-block">22. Alamat Sekarang:</span>
                        <span class="text-dark">{{ $application->heir_current_address ?: '-' }}</span>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted d-block">23. Alamat Asal:</span>
                        <span class="text-dark">{{ $application->heir_origin_address ?: '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- D. DATA KELUARGA LAIN (DARURAT) -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                <span class="badge rounded-circle p-2 text-white" style="background-color: #164b78; width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center;">D</span>
                <h2 class="h5 mb-0 fw-bold text-dark">DATA KELUARGA LAIN YANG BISA DIHUBUNGI</h2>
            </div>
            <div class="card-body p-4">
                <div class="row g-4 small">
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded border">
                            <h3 class="h6 fw-bold text-primary mb-2">Saudara Kandung</h3>
                            <span class="text-muted d-block">26. Nama:</span>
                            <strong class="d-block mb-2">{{ $application->emergency_sibling_name ?: '-' }}</strong>
                            <span class="text-muted d-block">28. No. Telp:</span>
                            <span class="d-block mb-2">{{ $application->emergency_sibling_phone ?: '-' }}</span>
                            <span class="text-muted d-block">27. Alamat:</span>
                            <span class="d-block">{{ $application->emergency_sibling_address ?: '-' }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded border">
                            <h3 class="h6 fw-bold text-primary mb-2">Saudara Lain</h3>
                            <span class="text-muted d-block">29. Nama:</span>
                            <strong class="d-block mb-2">{{ $application->emergency_other_name ?: '-' }}</strong>
                            <span class="text-muted d-block">31. No. Telp:</span>
                            <span class="d-block mb-2">{{ $application->emergency_other_phone ?: '-' }}</span>
                            <span class="text-muted d-block">30. Alamat:</span>
                            <span class="d-block">{{ $application->emergency_other_address ?: '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Right Column: Status Management & Uploaded Documents -->
    <div class="col-lg-4">

        <!-- STATUS MANAGEMENT -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-header bg-white py-3 px-4 border-bottom">
                <h2 class="h6 mb-0 fw-bold text-dark">
                    <i class="fas fa-tasks text-primary me-2"></i> Update Status & Catatan
                </h2>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.loan-applications.status', $application) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="status" class="form-label small fw-semibold">Status Pengajuan:</label>
                        <select name="status" id="status" class="form-select">
                            <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>Menunggu Survey / Verifikasi</option>
                            <option value="review" {{ $application->status === 'review' ? 'selected' : '' }}>Sedang Ditinjau</option>
                            <option value="approved" {{ $application->status === 'approved' ? 'selected' : '' }}>Disetujui</option>
                            <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="admin_notes" class="form-label small fw-semibold">Catatan Analis / Petugas:</label>
                        <textarea name="admin_notes" id="admin_notes" rows="4" class="form-control" placeholder="Tuliskan catatan hasil survei, persetujuan komite, plafon yang disetujui, atau alasan penolakan...">{{ old('admin_notes', $application->admin_notes) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-semibold" style="background-color: #164b78; border-color: #164b78;">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan Status
                    </button>
                </form>
            </div>
        </div>

        <!-- UPLOADED DOCUMENTS -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-header bg-white py-3 px-4 border-bottom">
                <h2 class="h6 mb-0 fw-bold text-dark">
                    <i class="fas fa-file-alt text-primary me-2"></i> Berkas Lampiran
                </h2>
            </div>
            <div class="card-body p-4">
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span>Foto / Scan KTP</span>
                        @if($application->ktp_file)
                            <a href="{{ asset('storage/' . $application->ktp_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-download me-1"></i> Lihat
                            </a>
                        @else
                            <span class="text-muted fst-italic">Belum ada</span>
                        @endif
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span>Kartu Keluarga / Nikah</span>
                        @if($application->kk_file)
                            <a href="{{ asset('storage/' . $application->kk_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-download me-1"></i> Lihat
                            </a>
                        @else
                            <span class="text-muted fst-italic">Belum ada</span>
                        @endif
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span>Dokumen Jaminan</span>
                        @if($application->collateral_file)
                            <a href="{{ asset('storage/' . $application->collateral_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-download me-1"></i> Lihat
                            </a>
                        @else
                            <span class="text-muted fst-italic">Belum ada</span>
                        @endif
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span>Slip Gaji / Bukti Usaha</span>
                        @if($application->income_slip_file)
                            <a href="{{ asset('storage/' . $application->income_slip_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-download me-1"></i> Lihat
                            </a>
                        @else
                            <span class="text-muted fst-italic">Belum ada</span>
                        @endif
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span>Denah Lokasi</span>
                        @if($application->location_sketch_file)
                            <a href="{{ asset('storage/' . $application->location_sketch_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-download me-1"></i> Lihat
                            </a>
                        @else
                            <span class="text-muted fst-italic">Belum ada</span>
                        @endif
                    </li>
                </ul>

                @if($application->notes)
                    <div class="mt-3 p-3 bg-light rounded border">
                        <strong class="d-block text-secondary small mb-1">Catatan Pemohon:</strong>
                        <p class="mb-0 small text-dark">{{ $application->notes }}</p>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
