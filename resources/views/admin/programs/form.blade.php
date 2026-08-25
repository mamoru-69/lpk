@extends('layouts.admin')

@section('content')
<div class="admin-page-head">
    <h2>{{ $program->exists ? 'Edit' : 'Tambah' }} Program</h2>
</div>

<form class="admin-card admin-form" method="POST" action="{{ $program->exists ? route('admin.programs.update', $program) : route('admin.programs.store') }}">
    @csrf
    @if($program->exists)
        @method('PUT')
    @endif

    <div class="row g-3">
        <div class="col-md-6">
            <label>Nama</label>
            <input class="form-control" name="name" value="{{ old('name', $program->name) }}" required>
        </div>
        <div class="col-md-6">
            <label>Kategori</label>
            <input class="form-control" name="category" value="{{ old('category', $program->category) }}" required>
        </div>
        <div class="col-12">
            <label>Ringkasan</label>
            <textarea class="form-control" name="short_description">{{ old('short_description', $program->short_description) }}</textarea>
        </div>
        <div class="col-12">
            <label>Deskripsi</label>
            <textarea class="form-control" rows="6" name="description">{{ old('description', $program->description) }}</textarea>
        </div>
        <div class="col-12">
            <label>Persyaratan</label>
            <textarea class="form-control" rows="4" name="requirements">{{ old('requirements', $program->requirements) }}</textarea>
        </div>
        <div class="col-md-4">
            <label>Durasi</label>
            <input class="form-control" name="duration" value="{{ old('duration', $program->duration) }}">
        </div>
        <div class="col-md-4">
            <label>Urutan</label>
            <input class="form-control" type="number" name="sort_order" value="{{ old('sort_order', $program->sort_order ?? 0) }}">
        </div>
        <div class="col-md-4 d-flex align-items-end gap-3 pb-3">
            <input type="hidden" name="is_featured" value="0">
            <label><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $program->is_featured))> Unggulan</label>
            <input type="hidden" name="is_active" value="0">
            <label><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $program->is_active ?? true))> Aktif</label>
        </div>
    </div>

    <button class="admin-btn mt-2">Simpan Program</button>
</form>
@endsection
