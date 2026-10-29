<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Panel Petugas — KSP Dharma Siaga</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/css/all.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #0b2d4d 0%, #164b78 100%);
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 1.5rem;
            margin: 0;
        }
        .login-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 440px;
            overflow: hidden;
        }
        .login-header {
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: 2rem 2rem 1.5rem;
            text-align: center;
        }
        .brand-badge {
            width: 54px;
            height: 54px;
            background: #0b2d4d;
            color: #ffffff;
            font-weight: 900;
            font-size: 24px;
            border-radius: 12px;
            display: inline-grid;
            place-items: center;
            margin-bottom: 1rem;
            box-shadow: 0 4px 10px rgba(11, 45, 77, 0.25);
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <div class="brand-badge">DS</div>
            <h1 class="h4 fw-bold text-dark mb-1">Panel Petugas</h1>
            <p class="text-muted small mb-0">KSP Dharma Siaga • Sistem Pengajuan Kredit</p>
        </div>

        <div class="p-4 p-md-5">
            @if(session('status'))
                <div class="alert alert-info py-2 px-3 small mb-3">
                    <i class="fas fa-info-circle me-1"></i> {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger py-2 px-3 small mb-3">
                    <i class="fas fa-exclamation-triangle me-1"></i> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label small fw-semibold text-secondary">Alamat Email Petugas</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', 'admin@dharmasiaga.co.id') }}" placeholder="admin@dharmasiaga.co.id" required autofocus>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label small fw-semibold text-secondary">Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror" id="password" name="password" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" checked>
                        <label class="form-check-label small text-secondary" for="remember">
                            Ingat sesi saya
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold" style="background-color: #0b2d4d; border-color: #0b2d4d; border-radius: 8px;">
                    <i class="fas fa-sign-in-alt me-1"></i> Masuk ke Panel
                </button>
            </form>

            <div class="mt-4 pt-3 border-top text-center">
                <a href="{{ route('home') }}" class="text-decoration-none small text-muted">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Website Publik
                </a>
            </div>
        </div>
    </div>

</body>
</html>
