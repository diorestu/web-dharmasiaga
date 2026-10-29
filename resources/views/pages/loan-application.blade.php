@extends('layouts.finbank')
@php($title = 'Formulir Permohonan Pinjaman Kredit — KSP Dharma Siaga')
@section('content')
@include('partials.template-breadcrumb', ['pageTitle' => 'Formulir Pengajuan Pinjaman'])

<section class="loan-application-section py-5 bg-light product-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">

                <!-- Header Info Box -->
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px; border-left: 5px solid #164b78 !important;">
                    <div class="card-body p-4 p-md-5">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
                            <div>
                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold" style="background-color: #e8f5e9; color: #1e7e34;">Layanan Kredit Koperasi</span>
                                <h1 class="h2 mt-2 mb-1 fw-bold text-dark">Formulir Permohonan Pinjaman</h1>
                                <p class="text-muted mb-0">KSP Dharma Siaga • BH. No.56/505/DISKOPPKM, 19 Januari 2004</p>
                            </div>
                            <div class="text-md-end">
                                <span class="text-muted small d-block">Tanggal Pengajuan:</span>
                                <strong class="fs-6 text-dark">{{ \Carbon\Carbon::parse($today)->translatedFormat('d F Y') }}</strong>
                            </div>
                        </div>
                        <p class="mb-0 text-secondary" style="font-size: 14px; line-height: 1.5; text-align: left !important;">
                            Silakan lengkapi formulir permohonan pinjaman di bawah ini sesuai dokumen identitas resmi (KTP). Formulir ini mengacu pada standar resmi <strong>KSP Dharma Siaga</strong>. Setelah formulir terkirim, staf kami akan melakukan verifikasi dan menghubungi Anda untuk proses survei serta akad kredit.
                        </p>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger shadow-sm mb-4" style="border-radius: 10px;">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-exclamation-triangle me-2 text-danger fs-5"></i>
                            <strong class="text-danger">Terdapat data yang belum lengkap atau perlu diperbaiki:</strong>
                        </div>
                        <ul class="mb-0 ps-4 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('loan-applications.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation">
                    @csrf
                    <input type="hidden" name="application_date" value="{{ old('application_date', $today) }}">

                    <!-- A. DATA PEMINJAM -->
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                        <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                            <span class="badge rounded-circle p-2 text-white" style="background-color: #164b78; width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center;">A</span>
                            <h3 class="h5 mb-0 fw-bold text-dark">DATA PEMINJAM</h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-semibold">1. Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Sesuai KTP" required>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold d-block">2. Pekerjaan / Usaha <span class="text-danger">*</span></label>
                                    <!-- Radio button list ke bawah -->
                                    <div class="d-flex flex-column gap-2 pt-1">
                                        @foreach(['Dagang', 'Pariwisata', 'Jasa', 'Industri', 'Pegawai', 'dll'] as $occ)
                                            <label class="radio-list-item" for="occ_{{ $occ }}">
                                                <input class="form-check-input occupation-radio me-3 mt-0" type="radio" name="occupation" id="occ_{{ $occ }}" value="{{ $occ }}" {{ old('occupation') === $occ ? 'checked' : '' }} required>
                                                <span class="text-dark flex-grow-1">{{ $occ }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                    <div id="occupation_other_wrapper" class="mt-2 {{ old('occupation') === 'dll' ? '' : 'd-none' }}">
                                        <input type="text" class="form-control" name="occupation_other" id="occupation_other" value="{{ old('occupation_other') }}" placeholder="Sebutkan pekerjaan/usaha Anda...">
                                    </div>
                                    @error('occupation')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="current_address" class="form-label fw-semibold">3. Alamat Sekarang (Domisili) <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('current_address') is-invalid @enderror" id="current_address" name="current_address" rows="2" placeholder="Alamat tinggal saat ini" required>{{ old('current_address') }}</textarea>
                                    @error('current_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="origin_address" class="form-label fw-semibold">4. Alamat Asal <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('origin_address') is-invalid @enderror" id="origin_address" name="origin_address" rows="2" placeholder="Alamat asal sesuai KTP" required>{{ old('origin_address') }}</textarea>
                                    @error('origin_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="correspondence_address" class="form-label fw-semibold">5. Alamat Korespondensi</label>
                                    <input type="text" class="form-control" id="correspondence_address" name="correspondence_address" value="{{ old('correspondence_address') }}" placeholder="Kosongkan jika sama dengan alamat sekarang">
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="form-label fw-semibold">6. No. Telp / WhatsApp <span class="text-danger">*</span></label>
                                    <input type="tel" inputmode="numeric" class="form-control phone-mask @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Contoh: 0812-3456-7890" required>
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="loan_amount_input" class="form-label fw-semibold">7. Jumlah Pinjaman (Rp) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light fw-bold text-dark">Rp</span>
                                        <input type="text" inputmode="numeric" class="form-control currency-mask @error('loan_amount') is-invalid @enderror" id="loan_amount_input" placeholder="Contoh: 50.000.000" value="{{ old('loan_amount') ? number_format((float) old('loan_amount'), 0, ',', '.') : '' }}" required>
                                        <input type="hidden" name="loan_amount" id="loan_amount" value="{{ old('loan_amount') }}">
                                    </div>
                                    <small class="text-muted">Plafon pinjaman KSP Dharma Siaga mulai Rp 1.000.000 hingga Rp 200.000.000+</small>
                                    @error('loan_amount')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="loan_purpose" class="form-label fw-semibold">8. Tujuan Pinjaman <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('loan_purpose') is-invalid @enderror" id="loan_purpose" name="loan_purpose" value="{{ old('loan_purpose') }}" placeholder="Contoh: Modal Usaha Dagang, Renovasi, Pendidikan, dll." required>
                                    @error('loan_purpose')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="loan_term_months" class="form-label fw-semibold">9. Jangka Waktu / Tenor <span class="text-danger">*</span></label>
                                    <select class="form-select ignore w-100 @error('loan_term_months') is-invalid @enderror" id="loan_term_months" name="loan_term_months" required style="width: 100% !important; display: block !important;">
                                        <option value="" disabled {{ old('loan_term_months') ? '' : 'selected' }}>Pilih jangka waktu...</option>
                                        <option value="6" {{ old('loan_term_months') == 6 ? 'selected' : '' }}>6 Bulan</option>
                                        <option value="12" {{ old('loan_term_months') == 12 ? 'selected' : '' }}>12 Bulan (1 Tahun)</option>
                                        <option value="24" {{ old('loan_term_months') == 24 ? 'selected' : '' }}>24 Bulan (2 Tahun)</option>
                                        <option value="36" {{ old('loan_term_months') == 36 ? 'selected' : '' }}>36 Bulan (3 Tahun)</option>
                                        <option value="48" {{ old('loan_term_months') == 48 ? 'selected' : '' }}>48 Bulan (4 Tahun)</option>
                                        <option value="60" {{ old('loan_term_months') == 60 ? 'selected' : '' }}>60 Bulan (5 Tahun)</option>
                                    </select>
                                    @error('loan_term_months')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="collateral_type" class="form-label fw-semibold">10. Agunan Pinjaman <span class="text-danger">*</span></label>
                                    <select class="form-select ignore w-100 @error('collateral_type') is-invalid @enderror" id="collateral_type" name="collateral_type" required style="width: 100% !important; display: block !important;">
                                        <option value="" disabled {{ old('collateral_type') ? '' : 'selected' }}>Pilih jenis agunan...</option>
                                        <option value="BPKB Sepeda Motor" {{ old('collateral_type') === 'BPKB Sepeda Motor' ? 'selected' : '' }}>BPKB Sepeda Motor</option>
                                        <option value="BPKB Mobil" {{ old('collateral_type') === 'BPKB Mobil' ? 'selected' : '' }}>BPKB Mobil</option>
                                        <option value="Sertifikat Hak Milik (SHM)" {{ old('collateral_type') === 'Sertifikat Hak Milik (SHM)' ? 'selected' : '' }}>Sertifikat Tanah / Bangunan (SHM)</option>
                                        <option value="Bilyet Simpanan Berjangka / SAHAM" {{ old('collateral_type') === 'Bilyet Simpanan Berjangka / SAHAM' ? 'selected' : '' }}>Bilyet Simpanan Berjangka / SAHAM</option>
                                        <option value="Lainnya" {{ old('collateral_type') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    <div class="mt-2">
                                        <input type="text" class="form-control" name="collateral_description" id="collateral_description" value="{{ old('collateral_description') }}" placeholder="Keterangan agunan (misal: Honda Vario 2022 DK 1234 AB / SHM No. 123)">
                                    </div>
                                    @error('collateral_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold d-block">11. Skema Pembayaran <span class="text-danger">*</span></label>
                                    <!-- Radio button list ke bawah -->
                                    <div class="d-flex flex-column gap-2 pt-1">
                                        @foreach(['Langsung', 'Transfer', 'Di Jemput', 'Debet Tabungan'] as $scheme)
                                            <label class="radio-list-item" for="scheme_{{ $loop->index }}">
                                                <input class="form-check-input me-3 mt-0" type="radio" name="payment_scheme" id="scheme_{{ $loop->index }}" value="{{ $scheme }}" {{ old('payment_scheme', 'Langsung') === $scheme ? 'checked' : '' }} required>
                                                <span class="text-dark flex-grow-1">{{ $scheme }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                    @error('payment_scheme')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="mother_maiden_name" class="form-label fw-semibold">12. Nama Ibu Kandung <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('mother_maiden_name') is-invalid @enderror" id="mother_maiden_name" name="mother_maiden_name" value="{{ old('mother_maiden_name') }}" placeholder="Nama ibu kandung peminjam" required>
                                    @error('mother_maiden_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- B. PENANGGUNG JAWAB -->
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                        <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                            <span class="badge rounded-circle p-2 text-white" style="background-color: #164b78; width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center;">B</span>
                            <h3 class="h5 mb-0 fw-bold text-dark">PENANGGUNG JAWAB</h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="guarantor_name" class="form-label fw-semibold">14. Nama Penanggung Jawab <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('guarantor_name') is-invalid @enderror" id="guarantor_name" name="guarantor_name" value="{{ old('guarantor_name') }}" placeholder="Nama penanggung jawab" required>
                                    @error('guarantor_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="guarantor_relationship" class="form-label fw-semibold">Hubungan Dengan Peminjam</label>
                                    <input type="text" class="form-control" id="guarantor_relationship" name="guarantor_relationship" value="{{ old('guarantor_relationship') }}" placeholder="Contoh: Suami / Istri / Orang Tua / Saudara">
                                </div>

                                <div class="col-md-6">
                                    <label for="guarantor_occupation" class="form-label fw-semibold">15. Pekerjaan</label>
                                    <input type="text" class="form-control" id="guarantor_occupation" name="guarantor_occupation" value="{{ old('guarantor_occupation') }}" placeholder="Pekerjaan penanggung jawab">
                                </div>

                                <div class="col-md-6">
                                    <label for="guarantor_phone" class="form-label fw-semibold">18. No. Telp / HP</label>
                                    <input type="tel" inputmode="numeric" class="form-control phone-mask" id="guarantor_phone" name="guarantor_phone" value="{{ old('guarantor_phone') }}" placeholder="Contoh: 0812-3456-7890">
                                </div>

                                <div class="col-md-6">
                                    <label for="guarantor_current_address" class="form-label fw-semibold">16. Alamat Sekarang</label>
                                    <textarea class="form-control" id="guarantor_current_address" name="guarantor_current_address" rows="2" placeholder="Alamat tinggal saat ini">{{ old('guarantor_current_address') }}</textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="guarantor_origin_address" class="form-label fw-semibold">17. Alamat Asal</label>
                                    <textarea class="form-control" id="guarantor_origin_address" name="guarantor_origin_address" rows="2" placeholder="Alamat asal sesuai KTP">{{ old('guarantor_origin_address') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- C. AHLI WARIS -->
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                        <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                            <span class="badge rounded-circle p-2 text-white" style="background-color: #164b78; width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center;">C</span>
                            <h3 class="h5 mb-0 fw-bold text-dark">AHLI WARIS</h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="heir_name" class="form-label fw-semibold">20. Nama Ahli Waris <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('heir_name') is-invalid @enderror" id="heir_name" name="heir_name" value="{{ old('heir_name') }}" placeholder="Nama ahli waris" required>
                                    @error('heir_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="heir_relationship" class="form-label fw-semibold">Hubungan Dengan Peminjam</label>
                                    <input type="text" class="form-control" id="heir_relationship" name="heir_relationship" value="{{ old('heir_relationship') }}" placeholder="Contoh: Anak / Istri / Suami">
                                </div>

                                <div class="col-md-6">
                                    <label for="heir_occupation" class="form-label fw-semibold">21. Pekerjaan</label>
                                    <input type="text" class="form-control" id="heir_occupation" name="heir_occupation" value="{{ old('heir_occupation') }}" placeholder="Pekerjaan ahli waris">
                                </div>

                                <div class="col-md-6">
                                    <label for="heir_phone" class="form-label fw-semibold">24. No. Telp / HP</label>
                                    <input type="tel" inputmode="numeric" class="form-control phone-mask" id="heir_phone" name="heir_phone" value="{{ old('heir_phone') }}" placeholder="Contoh: 0812-3456-7890">
                                </div>

                                <div class="col-md-6">
                                    <label for="heir_current_address" class="form-label fw-semibold">22. Alamat Sekarang</label>
                                    <textarea class="form-control" id="heir_current_address" name="heir_current_address" rows="2" placeholder="Alamat sekarang ahli waris">{{ old('heir_current_address') }}</textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="heir_origin_address" class="form-label fw-semibold">23. Alamat Asal</label>
                                    <textarea class="form-control" id="heir_origin_address" name="heir_origin_address" rows="2" placeholder="Alamat asal sesuai KTP">{{ old('heir_origin_address') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- D. DATA KELUARGA LAIN YANG BISA DIHUBUNGI -->
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                        <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                            <span class="badge rounded-circle p-2 text-white" style="background-color: #164b78; width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center;">D</span>
                            <h3 class="h5 mb-0 fw-bold text-dark">DATA KELUARGA LAIN YANG BISA DIHUBUNGI</h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-4 p-3 bg-light rounded-3 border">
                                <h4 class="h6 fw-bold text-primary mb-3">1. Saudara Kandung</h4>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="emergency_sibling_name" class="form-label small fw-semibold">26. Nama Saudara Kandung</label>
                                        <input type="text" class="form-control form-control-sm" id="emergency_sibling_name" name="emergency_sibling_name" value="{{ old('emergency_sibling_name') }}" placeholder="Nama lengkap saudara kandung">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="emergency_sibling_phone" class="form-label small fw-semibold">28. No. Telp</label>
                                        <input type="tel" inputmode="numeric" class="form-control form-control-sm phone-mask" id="emergency_sibling_phone" name="emergency_sibling_phone" value="{{ old('emergency_sibling_phone') }}" placeholder="Contoh: 0812-3456-7890">
                                    </div>
                                    <div class="col-12">
                                        <label for="emergency_sibling_address" class="form-label small fw-semibold">27. Alamat</label>
                                        <input type="text" class="form-control form-control-sm" id="emergency_sibling_address" name="emergency_sibling_address" value="{{ old('emergency_sibling_address') }}" placeholder="Alamat tinggal saudara kandung">
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 bg-light rounded-3 border">
                                <h4 class="h6 fw-bold text-primary mb-3">2. Saudara Lain</h4>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="emergency_other_name" class="form-label small fw-semibold">29. Nama Saudara Lain</label>
                                        <input type="text" class="form-control form-control-sm" id="emergency_other_name" name="emergency_other_name" value="{{ old('emergency_other_name') }}" placeholder="Nama saudara lainnya">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="emergency_other_phone" class="form-label small fw-semibold">31. No. Telp</label>
                                        <input type="tel" inputmode="numeric" class="form-control form-control-sm phone-mask" id="emergency_other_phone" name="emergency_other_phone" value="{{ old('emergency_other_phone') }}" placeholder="Contoh: 0812-3456-7890">
                                    </div>
                                    <div class="col-12">
                                        <label for="emergency_other_address" class="form-label small fw-semibold">30. Alamat</label>
                                        <input type="text" class="form-control form-control-sm" id="emergency_other_address" name="emergency_other_address" value="{{ old('emergency_other_address') }}" placeholder="Alamat tinggal saudara lainnya">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PERSYARATAN & BERKAS DOKUMEN (DROPZONE) -->
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                        <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                            <span class="badge rounded-circle p-2 text-white" style="background-color: #28a745; width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center;"><i class="fas fa-paperclip"></i></span>
                            <h3 class="h5 mb-0 fw-bold text-dark">PERSYARATAN DOKUMEN & CATATAN</h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="p-3 mb-4 rounded-3" style="background-color: #e8f5e9; border: 1px solid #c8e6c9;">
                                <h4 class="h6 fw-bold text-success mb-2"><i class="fas fa-info-circle me-1"></i> Persyaratan yang Harus Dilampirkan (1 Lembar Foto Copy):</h4>
                                <ul class="mb-0 small ps-3 text-secondary">
                                    <li>KTP Peminjam (Suami/Istri) dan Penanggung Jawab</li>
                                    <li>Kartu Keluarga atau Surat Nikah</li>
                                    <li>Dokumen Jaminan (BPKB & STNK / Sertifikat Hak Milik)</li>
                                    <li>Denah Lokasi Rumah / Usaha</li>
                                    <li>Slip Gaji / Bukti Usaha dan Bersedia di Survey</li>
                                </ul>
                                <small class="text-muted d-block mt-2"><em>* Berkas dapat diunggah melalui kotak dropzone di bawah ini atau diserahkan langsung saat tim survei KSP Dharma Siaga datang.</em></small>
                            </div>

                            <!-- Dropzone File Upload Grid -->
                            <div class="row g-4">
                                <!-- 1. KTP -->
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold d-block">Foto / Scan KTP (Peminjam & Penanggung Jawab)</label>
                                    <div class="dropzone-box" data-dropzone="ktp_file">
                                        <input type="file" id="ktp_file" name="ktp_file" class="d-none dropzone-input" accept=".pdf,.jpg,.jpeg,.png">
                                        <div class="dropzone-area p-3 text-center border-2 border-dashed rounded-3">
                                            <i class="fas fa-id-card fa-2x text-primary mb-2"></i>
                                            <div class="fw-semibold text-dark small">Tarik & lepas file di sini, atau <span class="text-primary text-decoration-underline">Pilih Berkas</span></div>
                                            <div class="text-muted" style="font-size: 11px;">PDF, JPG, JPEG, PNG (Maks. 5 MB)</div>
                                        </div>
                                        <div class="dropzone-preview p-3 border rounded-3 bg-white d-none align-items-center justify-content-between gap-3">
                                            <div class="d-flex align-items-center gap-3 overflow-hidden">
                                                <div class="dropzone-thumb-container rounded overflow-hidden flex-shrink-0" style="width: 52px; height: 52px; background: #f1f5f9; display: grid; place-items: center;">
                                                    <img src="" class="dropzone-thumb w-100 h-100 object-fit-cover d-none" alt="Preview">
                                                    <i class="fas fa-file-pdf fa-2x text-danger dropzone-pdf-icon d-none"></i>
                                                </div>
                                                <div class="overflow-hidden">
                                                    <strong class="d-block text-dark small text-truncate dropzone-filename">nama-file</strong>
                                                    <span class="text-muted dropzone-filesize" style="font-size: 11px;">0 MB</span>
                                                    <span class="badge bg-success-subtle text-success py-0 px-1" style="font-size: 10px;">Siap Diunggah</span>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-outline-danger btn-sm dropzone-remove flex-shrink-0 py-1 px-2" title="Ganti berkas">
                                                <i class="fas fa-trash-alt me-1"></i> Ganti
                                            </button>
                                        </div>
                                    </div>
                                    @error('ktp_file')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>

                                <!-- 2. KK -->
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold d-block">Foto / Scan Kartu Keluarga / Surat Nikah</label>
                                    <div class="dropzone-box" data-dropzone="kk_file">
                                        <input type="file" id="kk_file" name="kk_file" class="d-none dropzone-input" accept=".pdf,.jpg,.jpeg,.png">
                                        <div class="dropzone-area p-3 text-center border-2 border-dashed rounded-3">
                                            <i class="fas fa-users fa-2x text-primary mb-2"></i>
                                            <div class="fw-semibold text-dark small">Tarik & lepas file di sini, atau <span class="text-primary text-decoration-underline">Pilih Berkas</span></div>
                                            <div class="text-muted" style="font-size: 11px;">PDF, JPG, JPEG, PNG (Maks. 5 MB)</div>
                                        </div>
                                        <div class="dropzone-preview p-3 border rounded-3 bg-white d-none align-items-center justify-content-between gap-3">
                                            <div class="d-flex align-items-center gap-3 overflow-hidden">
                                                <div class="dropzone-thumb-container rounded overflow-hidden flex-shrink-0" style="width: 52px; height: 52px; background: #f1f5f9; display: grid; place-items: center;">
                                                    <img src="" class="dropzone-thumb w-100 h-100 object-fit-cover d-none" alt="Preview">
                                                    <i class="fas fa-file-pdf fa-2x text-danger dropzone-pdf-icon d-none"></i>
                                                </div>
                                                <div class="overflow-hidden">
                                                    <strong class="d-block text-dark small text-truncate dropzone-filename">nama-file</strong>
                                                    <span class="text-muted dropzone-filesize" style="font-size: 11px;">0 MB</span>
                                                    <span class="badge bg-success-subtle text-success py-0 px-1" style="font-size: 10px;">Siap Diunggah</span>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-outline-danger btn-sm dropzone-remove flex-shrink-0 py-1 px-2" title="Ganti berkas">
                                                <i class="fas fa-trash-alt me-1"></i> Ganti
                                            </button>
                                        </div>
                                    </div>
                                    @error('kk_file')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>

                                <!-- 3. JAMINAN -->
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold d-block">Foto / Scan Jaminan (BPKB & STNK / Sertifikat SHM)</label>
                                    <div class="dropzone-box" data-dropzone="collateral_file">
                                        <input type="file" id="collateral_file" name="collateral_file" class="d-none dropzone-input" accept=".pdf,.jpg,.jpeg,.png">
                                        <div class="dropzone-area p-3 text-center border-2 border-dashed rounded-3">
                                            <i class="fas fa-file-contract fa-2x text-primary mb-2"></i>
                                            <div class="fw-semibold text-dark small">Tarik & lepas file di sini, atau <span class="text-primary text-decoration-underline">Pilih Berkas</span></div>
                                            <div class="text-muted" style="font-size: 11px;">PDF, JPG, JPEG, PNG (Maks. 5 MB)</div>
                                        </div>
                                        <div class="dropzone-preview p-3 border rounded-3 bg-white d-none align-items-center justify-content-between gap-3">
                                            <div class="d-flex align-items-center gap-3 overflow-hidden">
                                                <div class="dropzone-thumb-container rounded overflow-hidden flex-shrink-0" style="width: 52px; height: 52px; background: #f1f5f9; display: grid; place-items: center;">
                                                    <img src="" class="dropzone-thumb w-100 h-100 object-fit-cover d-none" alt="Preview">
                                                    <i class="fas fa-file-pdf fa-2x text-danger dropzone-pdf-icon d-none"></i>
                                                </div>
                                                <div class="overflow-hidden">
                                                    <strong class="d-block text-dark small text-truncate dropzone-filename">nama-file</strong>
                                                    <span class="text-muted dropzone-filesize" style="font-size: 11px;">0 MB</span>
                                                    <span class="badge bg-success-subtle text-success py-0 px-1" style="font-size: 10px;">Siap Diunggah</span>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-outline-danger btn-sm dropzone-remove flex-shrink-0 py-1 px-2" title="Ganti berkas">
                                                <i class="fas fa-trash-alt me-1"></i> Ganti
                                            </button>
                                        </div>
                                    </div>
                                    @error('collateral_file')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>

                                <!-- 4. SLIP GAJI / BUKTI USAHA -->
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold d-block">Slip Gaji / Rekening Koran / Bukti Usaha</label>
                                    <div class="dropzone-box" data-dropzone="income_slip_file">
                                        <input type="file" id="income_slip_file" name="income_slip_file" class="d-none dropzone-input" accept=".pdf,.jpg,.jpeg,.png">
                                        <div class="dropzone-area p-3 text-center border-2 border-dashed rounded-3">
                                            <i class="fas fa-money-check-alt fa-2x text-primary mb-2"></i>
                                            <div class="fw-semibold text-dark small">Tarik & lepas file di sini, atau <span class="text-primary text-decoration-underline">Pilih Berkas</span></div>
                                            <div class="text-muted" style="font-size: 11px;">PDF, JPG, JPEG, PNG (Maks. 5 MB)</div>
                                        </div>
                                        <div class="dropzone-preview p-3 border rounded-3 bg-white d-none align-items-center justify-content-between gap-3">
                                            <div class="d-flex align-items-center gap-3 overflow-hidden">
                                                <div class="dropzone-thumb-container rounded overflow-hidden flex-shrink-0" style="width: 52px; height: 52px; background: #f1f5f9; display: grid; place-items: center;">
                                                    <img src="" class="dropzone-thumb w-100 h-100 object-fit-cover d-none" alt="Preview">
                                                    <i class="fas fa-file-pdf fa-2x text-danger dropzone-pdf-icon d-none"></i>
                                                </div>
                                                <div class="overflow-hidden">
                                                    <strong class="d-block text-dark small text-truncate dropzone-filename">nama-file</strong>
                                                    <span class="text-muted dropzone-filesize" style="font-size: 11px;">0 MB</span>
                                                    <span class="badge bg-success-subtle text-success py-0 px-1" style="font-size: 10px;">Siap Diunggah</span>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-outline-danger btn-sm dropzone-remove flex-shrink-0 py-1 px-2" title="Ganti berkas">
                                                <i class="fas fa-trash-alt me-1"></i> Ganti
                                            </button>
                                        </div>
                                    </div>
                                    @error('income_slip_file')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>

                                <!-- 5. DENAH LOKASI -->
                                <div class="col-12">
                                    <label class="form-label small fw-semibold d-block">Denah Lokasi (Foto gambar sketsa tangan / screenshot maps)</label>
                                    <div class="dropzone-box" data-dropzone="location_sketch_file">
                                        <input type="file" id="location_sketch_file" name="location_sketch_file" class="d-none dropzone-input" accept=".pdf,.jpg,.jpeg,.png">
                                        <div class="dropzone-area p-3 text-center border-2 border-dashed rounded-3">
                                            <i class="fas fa-map-marked-alt fa-2x text-primary mb-2"></i>
                                            <div class="fw-semibold text-dark small">Tarik & lepas file di sini, atau <span class="text-primary text-decoration-underline">Pilih Berkas</span></div>
                                            <div class="text-muted" style="font-size: 11px;">PDF, JPG, JPEG, PNG (Maks. 5 MB)</div>
                                        </div>
                                        <div class="dropzone-preview p-3 border rounded-3 bg-white d-none align-items-center justify-content-between gap-3">
                                            <div class="d-flex align-items-center gap-3 overflow-hidden">
                                                <div class="dropzone-thumb-container rounded overflow-hidden flex-shrink-0" style="width: 52px; height: 52px; background: #f1f5f9; display: grid; place-items: center;">
                                                    <img src="" class="dropzone-thumb w-100 h-100 object-fit-cover d-none" alt="Preview">
                                                    <i class="fas fa-file-pdf fa-2x text-danger dropzone-pdf-icon d-none"></i>
                                                </div>
                                                <div class="overflow-hidden">
                                                    <strong class="d-block text-dark small text-truncate dropzone-filename">nama-file</strong>
                                                    <span class="text-muted dropzone-filesize" style="font-size: 11px;">0 MB</span>
                                                    <span class="badge bg-success-subtle text-success py-0 px-1" style="font-size: 10px;">Siap Diunggah</span>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-outline-danger btn-sm dropzone-remove flex-shrink-0 py-1 px-2" title="Ganti berkas">
                                                <i class="fas fa-trash-alt me-1"></i> Ganti
                                            </button>
                                        </div>
                                    </div>
                                    @error('location_sketch_file')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12 mt-3">
                                    <label for="notes" class="form-label fw-semibold">Catatan Tambahan (Opsional):</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Tuliskan catatan khusus atau pesan untuk analis kredit KSP Dharma Siaga...">{{ old('notes') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PERNYATAAN & PERSETUJUAN -->
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px; background-color: #fff9e6; border: 1px solid #ffeeba !important;">
                        <div class="card-body p-4">
                            <h4 class="h6 fw-bold text-dark mb-2"><i class="fas fa-file-contract text-warning me-2"></i> PERNYATAAN DAN PERSETUJUAN</h4>
                            <p class="small text-muted mb-3" style="text-align: justify !important; line-height: 1.4;">
                                "Dengan ini saya menyatakan bahwa informasi ini adalah benar dan saya memberi persetujuan/kuasa kepada koperasi untuk menghubungi sumber manapun yang dianggap perlu untuk menegaskan kebenarannya. Demikian permohonan pinjaman ini saya ajukan dan apabila disetujui saya bersedia mentaati segala ketentuan yang berlaku."
                            </p>
                            <div class="form-check">
                                <input class="form-check-input @error('has_agreed') is-invalid @enderror" type="checkbox" name="has_agreed" value="1" id="has_agreed" {{ old('has_agreed', '1') ? 'checked' : '' }} required>
                                <label class="form-check-label fw-bold text-dark small" for="has_agreed">
                                    Saya menyetujui seluruh isi pernyataan dan bersedia mematuhi ketentuan permohonan pinjaman KSP Dharma Siaga. <span class="text-danger">*</span>
                                </label>
                                @error('has_agreed')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <!-- SUBMIT BUTTON -->
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 pt-2">
                        <a href="{{ route('pages.loans') }}" class="btn-one px-4 py-2" style="border-radius: 8px;">
                            <span class="txt"><i class="fas fa-arrow-left me-1"></i> Kembali ke Produk Pinjaman</span>
                        </a>
                        <button type="submit" class="btn-one px-5 py-3 fw-bold" style="border-radius: 8px; font-size: 16px;">
                            <span class="txt"><i class="fas fa-paper-plane me-2"></i> Kirim Permohonan Pinjaman</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Prevent niceSelect from breaking select on mobile / creating duplicate chevron arrows
    if (typeof jQuery !== 'undefined') {
        jQuery('.loan-application-section select').removeClass('nice-select');
        if (typeof jQuery.fn.niceSelect !== 'undefined') {
            jQuery('.loan-application-section select').niceSelect('destroy');
        }
    }

    // 2. Input Masking: Currency (Jumlah Pinjaman)
    const loanInput = document.getElementById('loan_amount_input');
    const loanHidden = document.getElementById('loan_amount');

    if (loanInput && loanHidden) {
        loanInput.addEventListener('input', function() {
            let val = this.value.replace(/\D/g, '');
            if (val !== '') {
                loanHidden.value = val;
                this.value = new Intl.NumberFormat('id-ID').format(val);
            } else {
                loanHidden.value = '';
                this.value = '';
            }
        });
    }

    // 3. Input Masking: Phone Numbers (Digits only with friendly format e.g. 0812-3456-7890)
    document.querySelectorAll('.phone-mask').forEach(input => {
        input.addEventListener('input', function() {
            let val = this.value.replace(/\D/g, '');
            if (val.length > 15) val = val.substring(0, 15);
            let formatted = '';
            if (val.length > 8) {
                formatted = val.substring(0, 4) + '-' + val.substring(4, 8) + '-' + val.substring(8);
            } else if (val.length > 4) {
                formatted = val.substring(0, 4) + '-' + val.substring(4);
            } else {
                formatted = val;
            }
            this.value = formatted;
        });
    });

    // 4. Radio toggle for "dll" pekerjaan
    const radios = document.querySelectorAll('.occupation-radio');
    const otherWrapper = document.getElementById('occupation_other_wrapper');
    radios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'dll') {
                otherWrapper.classList.remove('d-none');
            } else {
                otherWrapper.classList.add('d-none');
            }
        });
    });

    // 5. Interactive Dropzone File Uploader
    document.querySelectorAll('.dropzone-box').forEach(box => {
        const fileInput = box.querySelector('.dropzone-input');
        const dropArea = box.querySelector('.dropzone-area');
        const previewBox = box.querySelector('.dropzone-preview');
        const thumbImg = box.querySelector('.dropzone-thumb');
        const pdfIcon = box.querySelector('.dropzone-pdf-icon');
        const fileNameEl = box.querySelector('.dropzone-filename');
        const fileSizeEl = box.querySelector('.dropzone-filesize');
        const removeBtn = box.querySelector('.dropzone-remove');

        if (!fileInput || !dropArea || !previewBox) return;

        dropArea.addEventListener('click', () => fileInput.click());

        ['dragenter', 'dragover'].forEach(evt => {
            dropArea.addEventListener(evt, (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropArea.classList.add('dropzone-active');
            });
        });

        ['dragleave', 'drop'].forEach(evt => {
            dropArea.addEventListener(evt, (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropArea.classList.remove('dropzone-active');
            });
        });

        dropArea.addEventListener('drop', (e) => {
            if (e.dataTransfer && e.dataTransfer.files.length > 0) {
                fileInput.files = e.dataTransfer.files;
                handleFile(fileInput.files[0]);
            }
        });

        fileInput.addEventListener('change', () => {
            if (fileInput.files && fileInput.files.length > 0) {
                handleFile(fileInput.files[0]);
            }
        });

        removeBtn.addEventListener('click', () => {
            fileInput.value = '';
            dropArea.classList.remove('d-none');
            previewBox.classList.add('d-none');
            previewBox.classList.remove('d-flex');
            thumbImg.src = '';
            thumbImg.classList.add('d-none');
            pdfIcon.classList.add('d-none');
        });

        function handleFile(file) {
            if (!file) return;

            if (file.size > 5 * 1024 * 1024) {
                alert('Ukuran berkas ' + file.name + ' melebihi batas 5 MB.');
                fileInput.value = '';
                return;
            }

            fileNameEl.textContent = file.name;
            fileSizeEl.textContent = (file.size / (1024 * 1024)).toFixed(2) + ' MB';

            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    thumbImg.src = e.target.result;
                    thumbImg.classList.remove('d-none');
                    pdfIcon.classList.add('d-none');
                };
                reader.readAsDataURL(file);
            } else {
                thumbImg.classList.add('d-none');
                pdfIcon.classList.remove('d-none');
            }

            dropArea.classList.add('d-none');
            previewBox.classList.remove('d-none');
            previewBox.classList.add('d-flex');
        }
    });
});
</script>
@endsection
