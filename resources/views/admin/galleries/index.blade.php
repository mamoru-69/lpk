@extends('layouts.admin')

@section('content')
<div class="admin-page-head">
    <h2>Galeri</h2>
    <a class="admin-btn" href="{{ route('admin.galleries.create') }}">+ Tambah Foto</a>
</div>

<div class="admin-card">
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td>
                        @if($item->image)
                            <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" class="admin-thumb">
                        @endif
                    </td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->category ?: '-' }}</td>
                    <td><span class="admin-badge {{ $item->is_active ? 'success' : '' }}">{{ $item->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
                    <td class="text-nowrap">
                        <a href="{{ route('admin.galleries.edit', $item) }}" class="admin-link">Edit</a>
                        <form class="d-inline" method="POST" action="{{ route('admin.galleries.destroy', $item) }}" data-confirm="Foto galeri ini akan dihapus permanen." data-confirm-title="Hapus Foto?">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-link text-danger p-0 ms-2">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5">Belum ada foto galeri.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
