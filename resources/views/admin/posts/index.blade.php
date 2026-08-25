@extends('layouts.admin')

@section('content')
<div class="admin-page-head">
    <h2>Berita</h2>
    <a class="admin-btn" href="{{ route('admin.posts.create') }}">+ Tambah Berita</a>
</div>

<div class="admin-card">
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->published_at?->format('d/m/Y') ?? '-' }}</td>
                    <td><span class="admin-badge {{ $item->is_active ? 'success' : '' }}">{{ $item->is_active ? 'Publik' : 'Draft' }}</span></td>
                    <td class="text-nowrap">
                        <a href="{{ route('admin.posts.edit', $item) }}" class="admin-link">Edit</a>
                        <form class="d-inline" method="POST" action="{{ route('admin.posts.destroy', $item) }}" data-confirm="Berita ini akan dihapus permanen." data-confirm-title="Hapus Berita?">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-link text-danger p-0 ms-2">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4">Belum ada berita.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
