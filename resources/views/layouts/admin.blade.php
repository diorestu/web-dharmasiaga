<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Panel Petugas' }} — KSP Dharma Siaga</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/css/all.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #f4f7f9;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .admin-navbar {
            background-color: #0b2d4d;
            border-bottom: 3px solid #164b78;
        }
        .admin-navbar .navbar-brand {
            font-weight: 700;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .admin-navbar .nav-link {
            color: #cbd5e1;
            font-weight: 500;
            padding: 0.5rem 0.85rem;
            border-radius: 6px;
            transition: all 0.2s;
        }
        .admin-navbar .nav-link:hover, .admin-navbar .nav-link.active {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.12);
        }
        .badge-pending {
            background-color: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
        }
        .badge-review {
            background-color: #e0f2fe;
            color: #0369a1;
            border: 1px solid #bae6fd;
        }
        .badge-approved {
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        .badge-rejected {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        .stat-card {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.05);
        }
        .admin-table th {
            background-color: #f8fafc;
            color: #475569;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
            border-bottom: 2px solid #e2e8f0;
        }
        .admin-footer {
            margin-top: auto;
            background: #ffffff;
            border-top: 1px solid #e2e8f0;
            font-size: 0.85rem;
            color: #64748b;
        }
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <!-- Header Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark admin-navbar sticky-top no-print">
        <div class="container-fluid px-3 px-lg-4">
            <a class="navbar-brand" href="{{ route('admin.loan-applications.index') }}">
                <div style="width: 32px; height: 32px; background: #fff; border-radius: 6px; display: grid; place-items: center; color: #0b2d4d; font-weight: 900; font-size: 16px;">
                    DS
                </div>
                <span>Panel KSP Dharma Siaga</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3 gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.loan-applications.*') ? 'active' : '' }}" href="{{ route('admin.loan-applications.index') }}">
                            <i class="fas fa-file-invoice-dollar me-1"></i> Pengajuan Kredit
                            @php($pendingCount = \App\Models\LoanApplication::where('status', 'pending')->count())
                            @if($pendingCount > 0)
                                <span class="badge rounded-pill bg-warning text-dark ms-1">{{ $pendingCount }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.edit') ? 'active' : '' }}" href="{{ route('admin.edit') }}">
                            <i class="fas fa-sliders-h me-1"></i> Pengaturan Konten
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}" target="_blank">
                            <i class="fas fa-external-link-alt me-1"></i> Buka Website Publik
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-3">
                    <div class="text-end text-light d-none d-md-block">
                        <span class="d-block small text-light opacity-75">Login Sebagai:</span>
                        <strong class="d-block small">{{ auth()->user()->name ?? 'Administrator' }}</strong>
                    </div>

                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm px-3" title="Keluar dari panel">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        <div class="container-fluid px-3 px-lg-4">
            @if(session('status'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="admin-footer py-3 no-print">
        <div class="container-fluid px-3 px-lg-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <span>&copy; {{ date('Y') }} KSP Dharma Siaga • Sistem Pengajuan & Pengelolaan Kredit</span>
            <span class="small text-muted">Panel Akses Internal Petugas Koperasi</span>
        </div>
    </footer>

    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
