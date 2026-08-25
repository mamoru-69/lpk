<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login Admin - LPK CMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .swal-theme-popup { border-radius: 20px; }
        .swal-theme-title { font-weight: 800; }
        .swal2-styled.swal2-confirm { border-radius: 10px; font-weight: 700; }
        .swal2-styled.swal2-cancel { border-radius: 10px; font-weight: 700; }
    </style>
</head>
<body>
<div class="login-page">
    <section class="login-visual">
        <div>
            <div class="admin-brand-mark">日</div>
            <p class="mt-4 mb-0">LPK JAPAN CMS</p>
        </div>
        <div>
            <h1>Kelola website LPK dengan aman.</h1>
            <p>Masuk untuk mengelola program, pendaftar, berita, galeri, dan pengaturan website.</p>
        </div>
    </section>

    <section class="login-panel">
        <div class="login-card">
            <h2>Masuk Admin</h2>
            <p>Gunakan akun administrator Anda.</p>

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control mb-3" value="{{ old('email') }}" required autofocus>

                <label class="form-label fw-bold">Password</label>
                <input type="password" name="password" class="form-control mb-3" required>

                <label class="d-flex align-items-center gap-2 mb-3">
                    <input type="checkbox" name="remember" value="1">
                    <span>Ingat saya</span>
                </label>

                <button type="submit" class="login-submit">Masuk Dashboard</button>
            </form>

            <a href="{{ route('home') }}" class="d-inline-block mt-4 admin-link">← Kembali ke website</a>
        </div>
    </section>
</div>
@include('components.sweetalert')
</body>
</html>
