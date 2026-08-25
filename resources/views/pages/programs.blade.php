@extends('layouts.app')

@section('title', 'Program Lpk Ayumu Kaigo')

@section('content')
<section class="page-head">
    <div class="container page-head-inner">
        <span>PROGRAM</span>
        <h1>Program Pelatihan Jepang</h1>
        <p class="mb-0 opacity-75">Pilih jalur pembelajaran dan persiapan yang sesuai target Anda.</p>
    </div>
</section>

<div class="container py-5">
    <div class="page-actions reveal">
        @include('components.back-link', ['url' => route('home'), 'label' => 'Kembali ke Beranda'])
    </div>

    <div class="row g-4">
        @foreach($programs as $p)
        <div class="col-md-6">
            <div class="program-card h-100 reveal reveal-delay-{{ ($loop->index % 2) + 1 }}">
                <small>{{ $p->category }}</small>
                <h3>{{ $p->name }}</h3>
                <p>{{ $p->short_description }}</p>
                <div><b>Durasi:</b> {{ $p->duration ?: '-' }}</div>
                <a class="btn btn-sm btn-outline-danger mt-3" href="{{ route('programs.show', $p) }}">Detail Program</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/compro-japan.js') }}"></script>
@endsection
