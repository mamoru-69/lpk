@extends('layouts.app')

@section('title', 'Galeri')

@section('content')
<section class="page-head">
    <div class="container page-head-inner">
        <span>GALLERY</span>
        <h1>Kegiatan & Fasilitas</h1>
        <p class="mb-0 opacity-75">Dokumentasi kegiatan belajar, pelatihan, dan fasilitas LPK.</p>
    </div>
</section>

<div class="container py-5">
    @php
        $categories = $items->pluck('category')->filter()->unique()->values();
    @endphp

    @if($items->isNotEmpty())
        <div class="gallery-filters reveal">
            <button type="button" class="gallery-filter active" data-filter="all">Semua</button>
            @foreach($categories as $cat)
                <button type="button" class="gallery-filter" data-filter="{{ $cat }}">{{ $cat }}</button>
            @endforeach
        </div>

        <div class="gallery-grid">
            @foreach($items as $item)
                <button
                    type="button"
                    class="gallery-item reveal reveal-delay-{{ ($loop->index % 4) + 1 }}"
                    data-full="{{ $item->image ? asset('storage/'.$item->image) : '' }}"
                    data-title="{{ $item->title }}"
                    data-category="{{ $item->category }}"
                >
                    @if($item->image)
                        <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" loading="lazy">
                    @else
                        <div class="gallery-placeholder">写真</div>
                    @endif
                    <div class="gallery-item-overlay">
                        <span class="gallery-zoom-icon">+</span>
                        <h5 class="gallery-item-title">{{ $item->title }}</h5>
                        @if($item->category)
                            <small class="gallery-item-category">{{ $item->category }}</small>
                        @endif
                    </div>
                </button>
            @endforeach
        </div>
    @else
        <div class="gallery-placeholder reveal">Galeri belum diisi dari admin.</div>
    @endif
</div>

@if($items->isNotEmpty())
<div id="galleryLightbox" class="gallery-lightbox" aria-hidden="true">
    <button type="button" class="gallery-lightbox-zoom" aria-label="Zoom">Zoom</button>
    <button type="button" class="gallery-lightbox-close" aria-label="Tutup">&times;</button>
    <button type="button" class="gallery-lightbox-prev" aria-label="Sebelumnya">‹</button>
    <button type="button" class="gallery-lightbox-next" aria-label="Selanjutnya">›</button>
    <div class="gallery-lightbox-stage">
        <img id="galleryLightboxImg" src="" alt="">
    </div>
    <div class="gallery-lightbox-caption">
        <h5 id="galleryLightboxTitle"></h5>
        <small id="galleryLightboxCategory"></small>
        <span id="galleryLightboxCounter" class="gallery-lightbox-counter"></span>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script src="{{ asset('js/compro-japan.js') }}"></script>
@endsection
