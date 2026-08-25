@extends('layouts.app')

@section('title', '404 - Halaman Tidak Ditemukan')

@section('content')
<section class="error-page">
    <div class="error-bg-shape error-bg-shape-1"></div>
    <div class="error-bg-shape error-bg-shape-2"></div>

    <div class="container error-content">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="eyebrow hero-animate">404 • PAGE NOT FOUND</span>
                <div class="error-code hero-animate delay-1">404</div>
                <h1 class="error-title hero-animate delay-2">Halaman yang Anda cari<br><span>tidak ditemukan.</span></h1>
                <p class="error-text hero-animate delay-3">
                    Mungkin halaman sudah dipindahkan, dihapus, atau alamat URL salah ketik.
                    Silakan kembali ke beranda atau jelajahi menu di bawah.
                </p>
                <div class="d-flex gap-3 flex-wrap hero-animate delay-4">
                    <a href="{{ route('home') }}" class="btn btn-danger btn-lg">Kembali ke Beranda</a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-dark btn-lg">Hubungi Kami</a>
                </div>
            </div>

            <div class="col-lg-6 hero-animate delay-3">
                <div class="error-card">
                    <div class="error-card-sun"></div>
                    <p class="error-jp">道に迷いました</p>
                    <h3>Tersesat di perjalanan?</h3>
                    <p class="mb-4">Tidak apa-apa. Mari arahkan kembali langkah Anda menuju informasi program dan pendaftaran LPK.</p>
                    <div class="error-links">
                        <a href="{{ route('programs') }}">Program Pelatihan</a>
                        <a href="{{ route('registration.create') }}">Form Pendaftaran</a>
                        <a href="{{ route('faq') }}">FAQ</a>
                        <a href="{{ route('news') }}">Berita</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('js/compro-japan.js') }}"></script>
@endsection
