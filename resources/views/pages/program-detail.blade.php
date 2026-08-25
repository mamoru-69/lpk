@extends('layouts.app')

@section('title', $program->name)

@section('content')
<section class="page-head">
    <div class="container page-head-inner">
        <span>{{ $program->category }}</span>
        <h1>{{ $program->name }}</h1>
        <p>{{ $program->short_description }}</p>
    </div>
</section>

<div class="container py-5">
    <div class="page-actions reveal">
        @include('components.back-link', ['url' => route('programs'), 'label' => 'Kembali ke Program'])
    </div>

    <div class="row g-5">
        <div class="col-lg-8 reveal">
            <h3>Tentang Program</h3>
            <div>{!! nl2br(e($program->description ?: 'Detail program dapat diisi melalui admin CMS.')) !!}</div>
            <h3 class="mt-4">Persyaratan</h3>
            <div>{!! nl2br(e($program->requirements ?: 'Persyaratan mengikuti kebijakan program dan hasil seleksi LPK.')) !!}</div>
        </div>
        <div class="col-lg-4">
            <div class="info-box reveal reveal-delay-2">
                <h4>Ringkasan</h4>
                <p><b>Durasi:</b> {{ $program->duration ?: '-' }}</p>
                <p><b>Kategori:</b> {{ $program->category }}</p>
                <a href="{{ route('registration.create') }}" class="btn btn-danger w-100">Daftar Program</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/compro-japan.js') }}"></script>
@endsection
