@extends('layouts.admin')

@section('content')
<div class="admin-page-head">
    <h2>Pengaturan Website</h2>
</div>

<form class="admin-card admin-form admin-settings-form" method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="admin-settings-tabs" role="tablist" aria-label="Tab pengaturan website">
        <button type="button" class="admin-settings-tab active" data-settings-tab="general">Umum</button>
        <button type="button" class="admin-settings-tab" data-settings-tab="hero">Hero</button>
        <button type="button" class="admin-settings-tab" data-settings-tab="profile">Profil</button>
        <button type="button" class="admin-settings-tab" data-settings-tab="legal">Legalitas</button>
    </div>

    <section class="admin-settings-panel active" data-settings-panel="general">
        <div class="admin-settings-section-head">
            <h4>Setting Umum</h4>
            <p>Identitas utama, kontak, alamat, dan peta yang tampil di website.</p>
        </div>

        <div class="row g-3">
            @foreach(['site_name'=>'Nama LPK','phone'=>'Telepon','whatsapp'=>'WhatsApp (628xxx)','email'=>'Email'] as $key=>$label)
                <div class="col-md-6">
                    <label>{{ $label }}</label>
                    <input class="form-control" name="{{ $key }}" value="{{ $settings[$key] ?? '' }}">
                </div>
            @endforeach
        </div>

        @include('admin.settings.partials.localized-field', [
            'settings' => $settings,
            'name' => 'tagline',
            'label' => 'Tagline',
            'placeholder' => 'Belajar. Siap Kerja. Berangkat ke Jepang.',
        ])

        <label>Alamat Lengkap</label>
        <textarea class="form-control" rows="3" name="address">{{ $settings['address'] ?? '' }}</textarea>

        <label>Google Maps Embed URL</label>
        <input class="form-control" name="map_embed" value="{{ $settings['map_embed'] ?? '' }}" placeholder="https://www.google.com/maps/embed?pb=...">
        <small class="text-muted d-block mb-3">Salin URL dari Google Maps, lalu ambil nilai src iframe dari menu Sematkan peta.</small>
    </section>

    <section class="admin-settings-panel" data-settings-panel="hero">
        <div class="admin-settings-section-head">
            <h4>Setting Hero</h4>
            <p>Konten pembuka halaman utama dan gambar latar hero.</p>
        </div>

        @include('admin.settings.partials.localized-field', [
            'settings' => $settings,
            'name' => 'hero_title',
            'label' => 'Judul Hero',
            'placeholder' => 'Langkah Nyata Menuju Jepang',
        ])

        @include('admin.settings.partials.localized-field', [
            'settings' => $settings,
            'name' => 'hero_subtitle',
            'label' => 'Subjudul Hero',
            'type' => 'textarea',
            'rows' => 2,
            'placeholder' => 'Pelatihan bahasa Jepang, budaya kerja, dan persiapan program kerja Jepang secara terarah.',
        ])

        <label>Background Hero</label>
        @if(!empty($settings['hero_background']))
            <div class="mb-2">
                <img src="{{ asset('storage/'.$settings['hero_background']) }}" alt="Background hero" class="img-fluid rounded" style="max-height:180px">
            </div>
            <label class="d-block mb-3">
                <input type="checkbox" name="remove_hero_background" value="1"> Hapus background saat ini
            </label>
        @endif
        <input class="form-control" type="file" name="hero_background" accept="image/*">
        <small class="text-muted d-block mb-3">Format JPG/PNG/WebP, maks. 5 MB.</small>
    </section>

    <section class="admin-settings-panel" data-settings-panel="profile">
        <div class="admin-settings-section-head">
            <h4>Setting Profil</h4>
            <p>Konten halaman profil lembaga, visi, misi, dan identitas lembaga.</p>
        </div>

        @include('admin.settings.partials.localized-field', ['settings' => $settings, 'name' => 'profile_title', 'label' => 'Judul Profil', 'placeholder' => 'Profil LPK'])
        @include('admin.settings.partials.localized-field', ['settings' => $settings, 'name' => 'profile_subtitle', 'label' => 'Subjudul Profil', 'type' => 'textarea', 'rows' => 2, 'placeholder' => 'Kenali lembaga, visi, misi, dan fasilitas pelatihan.'])
        @include('admin.settings.partials.localized-field', ['settings' => $settings, 'name' => 'profile_about_title', 'label' => 'Judul Tentang Lembaga', 'placeholder' => 'Tentang Lembaga'])
        @include('admin.settings.partials.localized-field', ['settings' => $settings, 'name' => 'profile_about_body', 'label' => 'Isi Tentang Lembaga', 'type' => 'textarea', 'rows' => 5, 'placeholder' => 'Tulis profil resmi LPK di sini.'])
        @include('admin.settings.partials.localized-field', ['settings' => $settings, 'name' => 'profile_vision', 'label' => 'Visi', 'type' => 'textarea', 'rows' => 3, 'placeholder' => 'Tulis visi lembaga.'])
        @include('admin.settings.partials.localized-field', ['settings' => $settings, 'name' => 'profile_mission', 'label' => 'Misi', 'type' => 'textarea', 'rows' => 5, 'placeholder' => 'Tulis satu misi per baris.'])
        <small class="text-muted d-block mb-3">Tulis satu poin misi per baris agar tampil sebagai daftar.</small>

        <div class="row g-3">
            <div class="col-md-6">
                @include('admin.settings.partials.localized-field', ['settings' => $settings, 'name' => 'profile_identity_name', 'label' => 'Nama Lembaga di Profil'])
            </div>
            <div class="col-md-6">
                @include('admin.settings.partials.localized-field', ['settings' => $settings, 'name' => 'profile_identity_status', 'label' => 'Status Lembaga', 'placeholder' => 'Lembaga Pelatihan Kerja'])
            </div>
            <div class="col-md-6">
                @include('admin.settings.partials.localized-field', ['settings' => $settings, 'name' => 'profile_identity_focus', 'label' => 'Fokus Lembaga', 'placeholder' => 'Bahasa Jepang & Persiapan Kerja Jepang'])
            </div>
            <div class="col-md-6">
                @include('admin.settings.partials.localized-field', ['settings' => $settings, 'name' => 'profile_identity_area', 'label' => 'Area Layanan', 'placeholder' => 'Indonesia'])
            </div>
        </div>
    </section>

    <section class="admin-settings-panel" data-settings-panel="legal">
        <div class="admin-settings-section-head">
            <h4>Setting Legalitas</h4>
            <p>Konten halaman legalitas, catatan transparansi, dan kartu dokumen legal.</p>
        </div>

        @include('admin.settings.partials.localized-field', ['settings' => $settings, 'name' => 'legal_title', 'label' => 'Judul Legalitas', 'placeholder' => 'Legalitas & Transparansi'])
        @include('admin.settings.partials.localized-field', ['settings' => $settings, 'name' => 'legal_subtitle', 'label' => 'Subjudul Legalitas', 'type' => 'textarea', 'rows' => 2, 'placeholder' => 'Tampilkan dokumen izin dan identitas lembaga yang benar-benar dimiliki.'])

        <div class="row g-3">
            <div class="col-md-4">
                @include('admin.settings.partials.localized-field', ['settings' => $settings, 'name' => 'legal_nib_title', 'label' => 'Judul Kartu 1', 'placeholder' => 'NIB / Identitas Usaha'])
                @include('admin.settings.partials.localized-field', ['settings' => $settings, 'name' => 'legal_nib_body', 'label' => 'Isi Kartu 1', 'type' => 'textarea', 'rows' => 4, 'placeholder' => 'Isi nomor dan dokumen resmi.'])
            </div>
            <div class="col-md-4">
                @include('admin.settings.partials.localized-field', ['settings' => $settings, 'name' => 'legal_license_title', 'label' => 'Judul Kartu 2', 'placeholder' => 'Izin LPK'])
                @include('admin.settings.partials.localized-field', ['settings' => $settings, 'name' => 'legal_license_body', 'label' => 'Isi Kartu 2', 'type' => 'textarea', 'rows' => 4, 'placeholder' => 'Isi nomor izin dan instansi penerbit.'])
            </div>
            <div class="col-md-4">
                @include('admin.settings.partials.localized-field', ['settings' => $settings, 'name' => 'legal_partner_title', 'label' => 'Judul Kartu 3', 'placeholder' => 'Kerja Sama'])
                @include('admin.settings.partials.localized-field', ['settings' => $settings, 'name' => 'legal_partner_body', 'label' => 'Isi Kartu 3', 'type' => 'textarea', 'rows' => 4, 'placeholder' => 'Daftar mitra hanya jika ada dokumen kerja sama yang sah.'])
            </div>
        </div>
    </section>

    <div class="admin-settings-actions">
        <button class="admin-btn">Simpan Pengaturan</button>
    </div>
</form>

<script>
document.querySelectorAll('[data-settings-tab]').forEach((tab) => {
    tab.addEventListener('click', () => {
        const target = tab.dataset.settingsTab;

        document.querySelectorAll('[data-settings-tab]').forEach((item) => {
            item.classList.toggle('active', item === tab);
        });

        document.querySelectorAll('[data-settings-panel]').forEach((panel) => {
            panel.classList.toggle('active', panel.dataset.settingsPanel === target);
        });
    });
});
</script>
@endsection
