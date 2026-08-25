@extends('layouts.app')

@section('title', 'Pendaftaran')

@section('content')
<section class="page-head">
    <div class="container page-head-inner">
        <span>REGISTRATION</span>
        <h1>Pendaftaran Calon Peserta</h1>
        <p class="mb-0 opacity-75">Lengkapi data dan upload dokumen. Tim LPK akan melakukan verifikasi.</p>
    </div>
</section>

<div class="container py-5">
    <div class="form-shell">
        <form method="POST" action="{{ route('registration.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label>Nama lengkap *</label>
                    <input class="form-control" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-6">
                    <label>No. WhatsApp *</label>
                    <input class="form-control" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx" required>
                </div>
                <div class="col-md-6">
                    <label>NIK KTP *</label>
                    <input class="form-control" name="nik" value="{{ old('nik') }}" required>
                </div>
                <div class="col-md-3">
                    <label>Tempat lahir *</label>
                    <input class="form-control" name="birth_place" value="{{ old('birth_place') }}" required>
                </div>
                <div class="col-md-3">
                    <label>Tanggal lahir *</label>
                    <input type="date" class="form-control" name="birth_date" value="{{ old('birth_date') }}" required>
                </div>
                <div class="col-md-4">
                    <label>Jenis kelamin *</label>
                    <select class="form-select" name="gender" required>
                        <option value="">Pilih</option>
                        <option value="L" @selected(old('gender') === 'L')>Laki-laki</option>
                        <option value="P" @selected(old('gender') === 'P')>Perempuan</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Pendidikan *</label>
                    <input class="form-control" name="education" value="{{ old('education') }}" placeholder="SMA/SMK/D3/S1" required>
                </div>
                <div class="col-md-4">
                    <label>Level Jepang *</label>
                    <select class="form-select" name="japanese_level" required>
                        <option value="">Pilih level</option>
                        @foreach(['Belum pernah belajar','N5','N4','N3 atau lebih'] as $level)
                            <option @selected(old('japanese_level') === $level)>{{ $level }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Program diminati *</label>
                    <select class="form-select" name="program_id" required>
                        <option value="">Pilih program</option>
                        @foreach($programs as $p)
                            <option value="{{ $p->id }}" @selected(old('program_id') == $p->id)>{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Email *</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="col-12">
                    <label>Alamat *</label>
                    <textarea class="form-control" name="address" rows="3" required>{{ old('address') }}</textarea>
                </div>

                <div class="col-12"><hr><h5 class="mb-0">Upload Dokumen *</h5></div>

                <div class="col-md-4">
                    <label>Pas Foto *</label>
                    <input class="form-control" type="file" name="photo" accept=".jpg,.jpeg,.png" required>
                    <small class="text-muted">JPG/PNG, maks. 5 MB</small>
                </div>
                <div class="col-md-4">
                    <label>KTP *</label>
                    <input class="form-control" type="file" name="ktp" accept=".jpg,.jpeg,.png,.pdf" required>
                    <small class="text-muted">JPG/PNG/PDF, maks. 5 MB</small>
                </div>
                <div class="col-md-4">
                    <label>Ijazah *</label>
                    <input class="form-control" type="file" name="ijazah" accept=".jpg,.jpeg,.png,.pdf" required>
                    <small class="text-muted">JPG/PNG/PDF, maks. 5 MB</small>
                </div>

                <div class="col-12">
                    <button class="btn btn-danger btn-lg">Kirim Pendaftaran</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/compro-japan.js') }}"></script>
@endsection
