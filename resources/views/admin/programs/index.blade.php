@extends('layouts.admin')

@section('content')
<div class="admin-page-head">
    <h2>Program</h2>
    <a href="{{ route('admin.programs.create') }}" class="admin-btn">+ Tambah Program</a>
</div>

<div class="admin-card">
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($programs as $p)
                <tr>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->category }}</td>
                    <td>
                        <span class="admin-badge {{ $p->is_active ? 'success' : '' }}">
                            {{ $p->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td><a href="{{ route('admin.programs.edit', $p) }}" class="admin-link">Edit</a></td>
                </tr>
                @empty
                <tr><td colspan="4">Belum ada program.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
