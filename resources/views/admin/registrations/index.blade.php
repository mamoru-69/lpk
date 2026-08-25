@extends('layouts.admin')

@section('content')
<div class="admin-page-head">
    <h2>Pendaftar</h2>
</div>

<div class="admin-status-tabs">
    <a href="{{ route('admin.registrations.index') }}" class="admin-status-tab {{ empty($currentStatus) ? 'active' : '' }}">
        Semua <span>{{ $counts->sum() }}</span>
    </a>
    @foreach($statuses as $key => $label)
        <a href="{{ route('admin.registrations.index', ['status' => $key]) }}" class="admin-status-tab {{ $currentStatus === $key ? 'active' : '' }}">
            {{ $label }} <span>{{ $counts[$key] ?? 0 }}</span>
        </a>
    @endforeach
</div>

<div class="admin-card">
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>WhatsApp</th>
                    <th>Program</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $r)
                <tr>
                    <td>{{ $r->name }}</td>
                    <td>
                        <a href="{{ $r->whatsappUrl() }}" target="_blank" rel="noopener" class="admin-wa-link">{{ $r->phone }}</a>
                    </td>
                    <td>{{ $r->program?->name ?: 'Belum pilih program' }}</td>
                    <td>@include('components.admin.status-badge', ['status' => $r->status, 'label' => $r->statusLabel()])</td>
                    <td>{{ $r->created_at?->format('d/m/Y') }}</td>
                    <td><a href="{{ route('admin.registrations.show', $r) }}" class="admin-link">Kelola</a></td>
                </tr>
                @empty
                <tr><td colspan="6">Tidak ada pendaftar untuk filter ini.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $items->links() }}</div>
</div>
@endsection
