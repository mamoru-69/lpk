@extends('layouts.app')

@section('title', 'Berita')

@section('content')
<section class="page-head">
    <div class="container page-head-inner">
        <span>NEWS</span>
        <h1>Berita & Informasi</h1>
        <p class="mb-0 opacity-75">Update kegiatan, informasi program, dan pengumuman terbaru.</p>
    </div>
</section>

<div class="container py-5">
    <div class="page-actions reveal">
        @include('components.back-link', ['url' => route('home'), 'label' => 'Kembali ke Beranda'])
    </div>

    <div class="row g-4">
        @forelse($posts as $post)
        <div class="col-md-6 col-lg-4">
            <article class="news-card h-100 reveal reveal-delay-{{ ($loop->index % 3) + 1 }}">
                @if($post->image)
                    <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" loading="lazy">
                @endif
                <small>{{ $post->published_at?->format('d M Y') }}</small>
                <h4>{{ $post->title }}</h4>
                <p>{{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}</p>
                <a href="{{ route('news.show', $post) }}">Baca selengkapnya →</a>
            </article>
        </div>
        @empty
        <div class="col-12 text-center reveal">Belum ada berita.</div>
        @endforelse
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/compro-japan.js') }}"></script>
@endsection
