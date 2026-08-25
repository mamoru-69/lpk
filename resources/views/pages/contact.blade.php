@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
<section class="page-head">
    <div class="container page-head-inner">
        <span>CONTACT</span>
        <h1>Hubungi LPK</h1>
        <p class="mb-0 opacity-75">Konsultasikan program dan jadwal pendaftaran.</p>
    </div>
</section>

<div class="container py-5">
    <div class="row g-4">
        @if(!empty($settings['whatsapp']))
        <div class="col-md-4">
            <div class="info-box h-100">
                <h5>WhatsApp</h5>
                @if($waUrl = \App\Models\Setting::whatsappUrl($settings['whatsapp']))
                    <a href="{{ $waUrl }}" target="_blank" rel="noopener" class="contact-link">{{ $settings['whatsapp'] }}</a>
                @else
                    <p class="mb-0">{{ $settings['whatsapp'] }}</p>
                @endif
            </div>
        </div>
        @endif
        @if(!empty($settings['email']))
        <div class="col-md-4">
            <div class="info-box h-100">
                <h5>Email</h5>
                <a href="mailto:{{ $settings['email'] }}" class="contact-link">{{ $settings['email'] }}</a>
            </div>
        </div>
        @endif
        @if(!empty($settings['phone']))
        <div class="col-md-4">
            <div class="info-box h-100">
                <h5>Telepon</h5>
                <a href="tel:{{ preg_replace('/\s+/', '', $settings['phone']) }}" class="contact-link">{{ $settings['phone'] }}</a>
            </div>
        </div>
        @endif
        @if(!empty($settings['address']))
        <div class="col-12">
            <div class="info-box">
                <h5>Alamat</h5>
                <p class="mb-0">{{ $settings['address'] }}</p>
            </div>
        </div>
        @endif
        @if(!empty($settings['map_embed']))
        <div class="col-12">
            <div class="info-box p-0 overflow-hidden">
                <div class="site-footer-map site-footer-map-lg">
                    <iframe src="{{ $settings['map_embed'] }}" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/compro-japan.js') }}"></script>
@endsection
