@extends('layouts.app')

@php
    $setting = fn ($key, $default = null) => \App\Models\Setting::localized($settings, $key, $default);
    $profileTitle = $setting('profile_title', 'Profil LPK');
    $profileSubtitle = $setting('profile_subtitle', 'Kenali lembaga, sejarah, visi, misi, nilai, tim, dan fasilitas pelatihan.');
    $aboutTitle = $setting('profile_about_title', 'Tentang Lembaga');
    $aboutBody = $setting('profile_about_body', 'Isi profil resmi LPK Anda di sini. Jelaskan fokus pelatihan bahasa Jepang, pembinaan karakter, budaya kerja, dan program penempatan yang memang sah dimiliki lembaga.');
    $vision = $setting('profile_vision', 'Menjadi lembaga pelatihan kerja yang profesional dalam menyiapkan sumber daya manusia kompeten dan berkarakter untuk peluang kerja di Jepang.');
    $missionText = $setting('profile_mission', "Menyelenggarakan pelatihan bahasa Jepang yang terukur.\nMembentuk disiplin, etika, dan budaya kerja.\nMemberikan informasi program secara transparan.\nMendampingi kesiapan peserta sesuai jalur program.");
    $missions = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $missionText))));
@endphp

@section('title', $profileTitle)

@section('content')
<section class="page-head">
    <div class="container">
        <span>ABOUT US</span>
        <h1>{{ $profileTitle }}</h1>
        <p>{{ $profileSubtitle }}</p>
    </div>
</section>

<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-7">
            <h2>{{ $aboutTitle }}</h2>
            <p>{!! nl2br(e($aboutBody)) !!}</p>

            <h3 class="mt-4">Visi</h3>
            <p>{!! nl2br(e($vision)) !!}</p>

            <h3 class="mt-4">Misi</h3>
            <ul>
                @foreach($missions as $mission)
                    <li>{{ $mission }}</li>
                @endforeach
            </ul>
        </div>

        <div class="col-lg-5">
            <div class="info-box">
                <h4>Identitas Lembaga</h4>
                <p><b>Nama:</b> {{ $setting('profile_identity_name', $settings['site_name'] ?? 'LPK Sakura Indonesia') }}</p>
                <p><b>Status:</b> {{ $setting('profile_identity_status', 'Lembaga Pelatihan Kerja') }}</p>
                <p><b>Fokus:</b> {{ $setting('profile_identity_focus', 'Bahasa Jepang & Persiapan Kerja Jepang') }}</p>
                <p class="mb-0"><b>Area layanan:</b> {{ $setting('profile_identity_area', 'Indonesia') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
