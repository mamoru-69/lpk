@extends('layouts.app')

@php
    $legalTitle = $settings['legal_title'] ?? 'Legalitas & Transparansi';
    $legalSubtitle = $settings['legal_subtitle'] ?? 'Tampilkan dokumen izin dan identitas lembaga yang benar-benar dimiliki.';
    $legalCards = [
        [
            'title' => $settings['legal_nib_title'] ?? 'NIB / Identitas Usaha',
            'body' => $settings['legal_nib_body'] ?? 'Isi nomor dan dokumen resmi.',
        ],
        [
            'title' => $settings['legal_license_title'] ?? 'Izin LPK',
            'body' => $settings['legal_license_body'] ?? 'Isi nomor izin dan instansi penerbit.',
        ],
        [
            'title' => $settings['legal_partner_title'] ?? 'Kerja Sama',
            'body' => $settings['legal_partner_body'] ?? 'Daftar mitra hanya jika ada dokumen kerja sama yang sah.',
        ],
    ];
@endphp

@section('title', 'Legalitas')

@section('content')
<section class="page-head">
    <div class="container">
        <span>LEGAL & TRUST</span>
        <h1>{{ $legalTitle }}</h1>
        <p>{!! nl2br(e($legalSubtitle)) !!}</p>
    </div>
</section>

<div class="container py-5">
    <div class="row g-4">
        @foreach($legalCards as $card)
            <div class="col-md-4">
                <div class="legal-card h-100">
                    <h5>{{ $card['title'] }}</h5>
                    <p>{!! nl2br(e($card['body'])) !!}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
