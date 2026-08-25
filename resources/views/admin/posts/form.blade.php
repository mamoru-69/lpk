@extends('layouts.admin')

@section('content')
<div class="admin-page-head">
    <h2>{{ $post->exists ? 'Edit' : 'Tambah' }} Berita</h2>
</div>

<form class="admin-card admin-form" method="POST" action="{{ $post->exists ? route('admin.posts.update', $post) : route('admin.posts.store') }}" enctype="multipart/form-data">
    @csrf
    @if($post->exists)
        @method('PUT')
    @endif

    <label>Judul</label>
    <input class="form-control" name="title" value="{{ old('title', $post->title) }}" required>

    <label>Ringkasan</label>
    <textarea class="form-control" rows="2" name="excerpt">{{ old('excerpt', $post->excerpt) }}</textarea>

    <label>Isi Berita</label>
    <textarea class="form-control" rows="10" name="content" required>{{ old('content', $post->content) }}</textarea>

    <label>Tanggal Terbit</label>
    <input class="form-control" type="date" name="published_at" value="{{ old('published_at', optional($post->published_at)->format('Y-m-d') ?? now()->format('Y-m-d')) }}">

    <label>Gambar Utama</label>
    @if($post->image)
        <div class="mb-2"><img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" class="img-fluid rounded" style="max-height:180px"></div>
    @endif
    <input class="form-control" type="file" name="image" accept="image/*">

    <input type="hidden" name="is_active" value="0">
    <label class="d-block mb-3"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $post->is_active ?? true))> Publikasikan</label>

    <button class="admin-btn">Simpan Berita</button>
</form>
@endsection
