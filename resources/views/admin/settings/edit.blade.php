@extends('layouts.admin')

@section('content')
<div class="admin-page-head">
    <h2>Pengaturan Website</h2>
</div>

<form class="admin-card admin-form" method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @foreach(['site_name'=>'Nama LPK','tagline'=>'Tagline','phone'=>'Telepon','whatsapp'=>'WhatsApp (628xxx)','email'=>'Email'] as $key=>$label)
        <label>{{ $label }}</label>
        <input class="form-control" name="{{ $key }}" value="{{ $settings[$key] ?? '' }}">
    @endforeach

    <label>Alamat Lengkap</label>
    <textarea class="form-control" rows="3" name="address">{{ $settings['address'] ?? '' }}</textarea>

    <label>Google Maps Embed URL</label>
    <input class="form-control" name="map_embed" value="{{ $settings['map_embed'] ?? '' }}" placeholder="https://www.google.com/maps/embed?pb=...">
    <small class="text-muted d-block mb-3">Salin URL dari Google Maps → Bagikan → Sematkan peta → salin nilai src iframe.</small>

    @foreach(['hero_title'=>'Judul Hero','hero_subtitle'=>'Subjudul Hero'] as $key=>$label)
        <label>{{ $label }}</label>
        <input class="form-control" name="{{ $key }}" value="{{ $settings[$key] ?? '' }}">
    @endforeach

    <label>Background Hero</label>
    @if(!empty($settings['hero_background']))
        <div class="mb-2"><img src="{{ asset('storage/'.$settings['hero_background']) }}" alt="Background hero" class="img-fluid rounded" style="max-height:180px"></div>
        <label class="d-block mb-3"><input type="checkbox" name="remove_hero_background" value="1"> Hapus background saat ini</label>
    @endif
    <input class="form-control" type="file" name="hero_background" accept="image/*">
    <small class="text-muted d-block mb-3">Format JPG/PNG/WebP, maks. 5 MB.</small>

    <hr class="my-4">
    <h4 class="mb-3">Setting Profil</h4>

    <label>Judul Profil</label>
    <input class="form-control" name="profile_title" value="{{ $settings['profile_title'] ?? '' }}" placeholder="Profil LPK">

    <label>Subjudul Profil</label>
    <textarea class="form-control" rows="2" name="profile_subtitle" placeholder="Kenali lembaga, visi, misi, dan fasilitas pelatihan.">{{ $settings['profile_subtitle'] ?? '' }}</textarea>

    <label>Judul Tentang Lembaga</label>
    <input class="form-control" name="profile_about_title" value="{{ $settings['profile_about_title'] ?? '' }}" placeholder="Tentang Lembaga">

    <label>Isi Tentang Lembaga</label>
    <textarea class="form-control" rows="5" name="profile_about_body" placeholder="Tulis profil resmi LPK di sini.">{{ $settings['profile_about_body'] ?? '' }}</textarea>

    <label>Visi</label>
    <textarea class="form-control" rows="3" name="profile_vision" placeholder="Tulis visi lembaga.">{{ $settings['profile_vision'] ?? '' }}</textarea>

    <label>Misi</label>
    <textarea class="form-control" rows="5" name="profile_mission" placeholder="Tulis satu misi per baris.">{{ $settings['profile_mission'] ?? '' }}</textarea>
    <small class="text-muted d-block mb-3">Tulis satu poin misi per baris agar tampil sebagai daftar.</small>

    <div class="row g-3">
        <div class="col-md-6">
            <label>Nama Lembaga di Profil</label>
            <input class="form-control" name="profile_identity_name" value="{{ $settings['profile_identity_name'] ?? '' }}">
        </div>
        <div class="col-md-6">
            <label>Status Lembaga</label>
            <input class="form-control" name="profile_identity_status" value="{{ $settings['profile_identity_status'] ?? '' }}" placeholder="Lembaga Pelatihan Kerja">
        </div>
        <div class="col-md-6">
            <label>Fokus Lembaga</label>
            <input class="form-control" name="profile_identity_focus" value="{{ $settings['profile_identity_focus'] ?? '' }}" placeholder="Bahasa Jepang & Persiapan Kerja Jepang">
        </div>
        <div class="col-md-6">
            <label>Area Layanan</label>
            <input class="form-control" name="profile_identity_area" value="{{ $settings['profile_identity_area'] ?? '' }}" placeholder="Indonesia">
        </div>
    </div>

    <hr class="my-4">
    <h4 class="mb-3">Setting Legalitas</h4>

    <label>Judul Legalitas</label>
    <input class="form-control" name="legal_title" value="{{ $settings['legal_title'] ?? '' }}" placeholder="Legalitas & Transparansi">

    <label>Subjudul Legalitas</label>
    <textarea class="form-control" rows="2" name="legal_subtitle" placeholder="Tampilkan dokumen izin dan identitas lembaga yang benar-benar dimiliki.">{{ $settings['legal_subtitle'] ?? '' }}</textarea>

    <label>Catatan Legalitas</label>
    <textarea class="form-control" rows="3" name="legal_notice" placeholder="Jangan menampilkan nomor izin, status SO, mitra Jepang, akreditasi, atau klaim penempatan yang belum dapat diverifikasi.">{{ $settings['legal_notice'] ?? '' }}</textarea>

    <div class="row g-3">
        <div class="col-md-4">
            <label>Judul Kartu 1</label>
            <input class="form-control" name="legal_nib_title" value="{{ $settings['legal_nib_title'] ?? '' }}" placeholder="NIB / Identitas Usaha">
            <label>Isi Kartu 1</label>
            <textarea class="form-control" rows="4" name="legal_nib_body" placeholder="Isi nomor dan dokumen resmi.">{{ $settings['legal_nib_body'] ?? '' }}</textarea>
        </div>
        <div class="col-md-4">
            <label>Judul Kartu 2</label>
            <input class="form-control" name="legal_license_title" value="{{ $settings['legal_license_title'] ?? '' }}" placeholder="Izin LPK">
            <label>Isi Kartu 2</label>
            <textarea class="form-control" rows="4" name="legal_license_body" placeholder="Isi nomor izin dan instansi penerbit.">{{ $settings['legal_license_body'] ?? '' }}</textarea>
        </div>
        <div class="col-md-4">
            <label>Judul Kartu 3</label>
            <input class="form-control" name="legal_partner_title" value="{{ $settings['legal_partner_title'] ?? '' }}" placeholder="Kerja Sama">
            <label>Isi Kartu 3</label>
            <textarea class="form-control" rows="4" name="legal_partner_body" placeholder="Daftar mitra hanya jika ada dokumen kerja sama yang sah.">{{ $settings['legal_partner_body'] ?? '' }}</textarea>
        </div>
    </div>

    <button class="admin-btn">Simpan Pengaturan</button>
</form>
@endsection
