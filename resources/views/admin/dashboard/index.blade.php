@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Dashboard</h1>
        <p>Selamat datang, {{ auth()->user()->name }}.</p>
    </div>
    <a href="{{ route('admin.registrations.index') }}" class="admin-btn">Lihat Pendaftar</a>
</div>

<div class="admin-stat-grid">
    <div class="admin-stat accent">
        <small>Total Pendaftar</small>
        <h2>{{ $totalRegistrations }}</h2>
    </div>
    <div class="admin-stat">
        <small>Belum Dihubungi</small>
        <h2>{{ $statusCounts['baru'] ?? 0 }}</h2>
    </div>
    <div class="admin-stat">
        <small>Sedang Diproses</small>
        <h2>{{ ($statusCounts['dihubungi'] ?? 0) + ($statusCounts['seleksi'] ?? 0) }}</h2>
    </div>
    <div class="admin-stat">
        <small>Program Aktif</small>
        <h2>{{ $totalPrograms }}</h2>
    </div>
</div>

<div class="admin-card">
    <div class="admin-page-head">
        <h2>Pendaftar Terbaru</h2>
        <a href="{{ route('admin.registrations.index', ['status' => 'baru']) }}" class="admin-link">Lihat yang belum dihubungi →</a>
    </div>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>WhatsApp</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($registrations as $r)
                <tr>
                    <td>{{ $r->name }}</td>
                    <td>{{ $r->phone }}</td>
                    <td>@include('components.admin.status-badge', ['status' => $r->status, 'label' => $r->statusLabel()])</td>
                    <td>{{ $r->created_at?->format('d/m/Y') }}</td>
                    <td><a href="{{ route('admin.registrations.show', $r) }}" class="admin-link">Kelola</a></td>
                </tr>
                @empty
                <tr><td colspan="5">Belum ada pendaftar.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
