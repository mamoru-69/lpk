<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'Admin CMS')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @yield('styles')
    <style>
        .swal-theme-popup { border-radius: 20px; }
        .swal-theme-title { font-weight: 800; }
        .swal2-styled.swal2-confirm { border-radius: 10px; font-weight: 700; }
        .swal2-styled.swal2-cancel { border-radius: 10px; font-weight: 700; }
    </style>
</head>
<body class="admin-body">
<div class="admin-shell">
    <aside class="admin-sidebar">
        <div class="admin-brand">
            <div class="admin-brand-mark">日</div>
            <div>
                <h5>LPK CMS</h5>
                <small>Panel Administrator</small>
            </div>
        </div>

        <nav class="admin-nav">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="admin-nav-icon">⌂</span> Dashboard
            </a>
            <a href="{{ route('admin.programs.index') }}" class="{{ request()->routeIs('admin.programs.*') ? 'active' : '' }}">
                <span class="admin-nav-icon">📚</span> Program
            </a>
            <a href="{{ route('admin.registrations.index') }}" class="{{ request()->routeIs('admin.registrations.*') ? 'active' : '' }}">
                <span class="admin-nav-icon">👥</span> Pendaftar
            </a>
            <a href="{{ route('admin.faqs.index') }}" class="{{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                <span class="admin-nav-icon">❓</span> FAQ
            </a>
            <a href="{{ route('admin.galleries.index') }}" class="{{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
                <span class="admin-nav-icon">🖼</span> Galeri
            </a>
            <a href="{{ route('admin.posts.index') }}" class="{{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                <span class="admin-nav-icon">📰</span> Berita
            </a>
            <a href="{{ route('admin.settings.edit') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <span class="admin-nav-icon">⚙</span> Pengaturan
            </a>
            <a href="{{ route('home') }}" target="_blank">
                <span class="admin-nav-icon">↗</span> Lihat Website
            </a>
        </nav>

        <div class="admin-sidebar-footer">
            <div class="admin-user">
                <div class="admin-user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div>
                    <strong>{{ auth()->user()->name }}</strong>
                    <small>{{ auth()->user()->email }}</small>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="admin-logout">Keluar</button>
            </form>
        </div>
    </aside>

    <main class="admin-main">
        @yield('content')
    </main>
</div>
@include('components.sweetalert')
@yield('scripts')
</body>
</html>
