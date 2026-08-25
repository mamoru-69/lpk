@extends('layouts.admin')

@section('content')
<div class="admin-page-head">
    <h2>{{ $gallery->exists ? 'Edit' : 'Tambah' }} Galeri</h2>
</div>

<form class="admin-card admin-form" method="POST" action="{{ $gallery->exists ? route('admin.galleries.update', $gallery) : route('admin.galleries.store') }}" enctype="multipart/form-data">
    @csrf
    @if($gallery->exists)
        @method('PUT')
    @endif

    <label>Judul</label>
    <input class="form-control" name="title" value="{{ old('title', $gallery->title) }}" required>

    <label>Kategori</label>
    <input class="form-control" name="category" value="{{ old('category', $gallery->category) }}" placeholder="Kegiatan, Fasilitas, dll">

    <label>Urutan</label>
    <input class="form-control" type="number" name="sort_order" value="{{ old('sort_order', $gallery->sort_order ?? 0) }}">

    <label>Gambar @unless($gallery->exists)<span class="text-danger">*</span>@endunless</label>
    @if($gallery->image)
        <div class="mb-2"><img src="{{ asset('storage/'.$gallery->image) }}" alt="{{ $gallery->title }}" class="img-fluid rounded" style="max-height:180px"></div>
    @endif
    <input class="form-control" type="file" name="image" accept="image/*" {{ $gallery->exists ? '' : 'required' }}>

    <input type="hidden" name="is_active" value="0">
    <label class="d-block mb-3"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $gallery->is_active ?? true))> Tampilkan di website</label>

    <button class="admin-btn">Simpan Galeri</button>
</form>
@endsection
