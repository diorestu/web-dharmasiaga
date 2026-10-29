@extends('layouts.admin')
@php($title = 'Daftar Pengajuan Pinjaman Kredit')

@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <h1 class="h3 fw-bold text-dark mb-1">Pengajuan Pinjaman Kredit</h1>
        <p class="text-muted small mb-0">Kelola dan pantau seluruh permohonan pinjaman anggota KSP Dharma Siaga.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('loan-applications.create') }}" target="_blank" class="btn btn-outline-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Buka Formulir Publik
        </a>
    </div>
</div>

<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-4 col-xl-2">
        <div class="stat-card p-3">
            <span class="text-muted small text-uppercase fw-semibold d-block">Total Masuk</span>
            <span class="h4 fw-bold text-dark mb-0 d-block mt-1">{{ number_format($stats['total']) }}</span>
            <small class="text-muted">Semua permohonan</small>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="stat-card p-3" style="border-left: 4px solid #f59e0b !important;">
            <span class="text-muted small text-uppercase fw-semibold d-block">Menunggu Survey</span>
            <span class="h4 fw-bold text-warning mb-0 d-block mt-1">{{ number_format($stats['pending']) }}</span>
            <small class="text-muted">Perlu tindak lanjut</small>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="stat-card p-3" style="border-left: 4px solid #0284c7 !important;">
            <span class="text-muted small text-uppercase fw-semibold d-block">Sedang Ditinjau</span>
            <span class="h4 fw-bold text-info mb-0 d-block mt-1">{{ number_format($stats['review']) }}</span>
            <small class="text-muted">Dalam proses analisis</small>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="stat-card p-3" style="border-left: 4px solid #16a34a !important;">
            <span class="text-muted small text-uppercase fw-semibold d-block">Disetujui</span>
            <span class="h4 fw-bold text-success mb-0 d-block mt-1">{{ number_format($stats['approved']) }}</span>
            <small class="text-muted">Siap pencairan</small>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="stat-card p-3" style="border-left: 4px solid #dc2626 !important;">
            <span class="text-muted small text-uppercase fw-semibold d-block">Ditolak</span>
            <span class="h4 fw-bold text-danger mb-0 d-block mt-1">{{ number_format($stats['rejected']) }}</span>
            <small class="text-muted">Tidak memenuhi syarat</small>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="stat-card p-3" style="border-left: 4px solid #0b2d4d !important;">
            <span class="text-muted small text-uppercase fw-semibold d-block">Total Plafon</span>
            <span class="h5 fw-bold text-primary mb-0 d-block mt-1">Rp {{ number_format($stats['total_amount'] / 1000000, 1, ',', '.') }} Jt</span>
            <small class="text-muted">Nominal diajukan</small>
        </div>
    </div>
</div>

<!-- Filter & Search Toolbar -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
    <div class="card-body p-3">
        <div class="row g-2 align-items-center justify-content-between">
            <div class="col-md-7">
                <!-- Status Tabs -->
                <div class="nav nav-pills small gap-1">
                    <a class="nav-link py-1 px-3 {{ $status === 'all' || !$status ? 'active' : 'bg-light text-dark' }}" href="{{ route('admin.loan-applications.index', ['status' => 'all', 'q' => $search]) }}">
                        Semua ({{ $stats['total'] }})
                    </a>
                    <a class="nav-link py-1 px-3 {{ $status === 'pending' ? 'active' : 'bg-light text-dark' }}" href="{{ route('admin.loan-applications.index', ['status' => 'pending', 'q' => $search]) }}">
                        Menunggu Survey ({{ $stats['pending'] }})
                    </a>
                    <a class="nav-link py-1 px-3 {{ $status === 'review' ? 'active' : 'bg-light text-dark' }}" href="{{ route('admin.loan-applications.index', ['status' => 'review', 'q' => $search]) }}">
                        Ditinjau ({{ $stats['review'] }})
                    </a>
                    <a class="nav-link py-1 px-3 {{ $status === 'approved' ? 'active' : 'bg-light text-dark' }}" href="{{ route('admin.loan-applications.index', ['status' => 'approved', 'q' => $search]) }}">
                        Disetujui ({{ $stats['approved'] }})
                    </a>
                    <a class="nav-link py-1 px-3 {{ $status === 'rejected' ? 'active' : 'bg-light text-dark' }}" href="{{ route('admin.loan-applications.index', ['status' => 'rejected', 'q' => $search]) }}">
                        Ditolak ({{ $stats['rejected'] }})
                    </a>
                </div>
            </div>

            <div class="col-md-5">
                <form action="{{ route('admin.loan-applications.index') }}" method="GET" class="d-flex gap-2">
                    <input type="hidden" name="status" value="{{ $status }}">
                    <div class="input-group input-group-sm">
                        <input type="search" name="q" class="form-control" placeholder="Cari nama, ref, telepon, usaha..." value="{{ $search }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    @if($search)
                        <a href="{{ route('admin.loan-applications.index', ['status' => $status]) }}" class="btn btn-outline-danger btn-sm" title="Hapus pencarian">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Applications Data Table -->
<div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
    <div class="table-responsive">
        <table class="table admin-table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th class="ps-4">No. Referensi / Tgl</th>
                    <th>Nama Peminjam</th>
                    <th>Kontak / WA</th>
                    <th>Pekerjaan</th>
                    <th>Plafon Diajukan</th>
                    <th>Tenor</th>
                    <th>Agunan</th>
                    <th>Status</th>
                    <th class="text-end pe-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $app)
                    <tr>
                        <td class="ps-4">
                            <strong class="d-block text-dark small font-monospace">{{ $app->reference_number }}</strong>
                            <span class="text-muted small">{{ $app->application_date ? $app->application_date->format('d/m/Y') : '-' }}</span>
                        </td>
                        <td>
                            <strong class="d-block text-dark">{{ $app->name }}</strong>
                            <span class="text-muted small">Ibu: {{ $app->mother_maiden_name }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <span class="small">{{ $app->phone }}</span>
                                <a href="{{ $app->applicant_whatsapp_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-success p-1 px-2 rounded-circle" title="Chat via WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $app->occupation === 'dll' ? $app->occupation_other : $app->occupation }}</span>
                        </td>
                        <td>
                            <strong class="text-primary">{{ $app->formatted_loan_amount }}</strong>
                            <span class="d-block text-muted small">{{ $app->loan_purpose }}</span>
                        </td>
                        <td>
                            <span class="badge bg-light text-secondary border">{{ $app->loan_term_months }} Bln</span>
                        </td>
                        <td>
                            <span class="small d-block text-truncate" style="max-width: 150px;" title="{{ $app->collateral_type }} - {{ $app->collateral_description }}">
                                {{ $app->collateral_type }}
                            </span>
                        </td>
                        <td>
                            <span class="badge {{ $app->status_badge_class }} px-2 py-1">
                                {{ $app->status_label }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.loan-applications.show', $app) }}" class="btn btn-outline-primary" title="Lihat detail lengkap">
                                    <i class="fas fa-eye me-1"></i> Detail
                                </a>
                                <a href="{{ route('admin.loan-applications.print', $app) }}" target="_blank" class="btn btn-outline-secondary" title="Cetak formulir">
                                    <i class="fas fa-print"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-5">
                            <div class="text-muted">
                                <i class="fas fa-folder-open fa-3x mb-3 text-secondary opacity-50"></i>
                                <p class="mb-1 fw-semibold">Tidak ada data pengajuan pinjaman yang ditemukan.</p>
                                <span class="small">Silakan ubah filter status atau kata kunci pencarian.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($applications->hasPages())
        <div class="card-footer bg-white py-3 px-4 border-top">
            {{ $applications->links() }}
        </div>
    @endif
</div>
@endsection
