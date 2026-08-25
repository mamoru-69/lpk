@extends('layouts.app')

@section('title', $post->title)

@section('content')
<section class="page-head">
    <div class="container page-head-inner">
        <span>BERITA</span>
        <h1>{{ $post->title }}</h1>
        <p class="mb-0 opacity-75">{{ $post->published_at?->format('d F Y') }}</p>
    </div>
</section>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="page-actions">
                @include('components.back-link', ['url' => route('news'), 'label' => 'Kembali ke Berita'])
            </div>

            <article class="info-box reveal">
                @if($post->image)
                    <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" class="article-cover">
                @endif
                @if($post->excerpt)
                    <p class="lead">{{ $post->excerpt }}</p>
                @endif
                <div>{!! nl2br(e($post->content)) !!}</div>
            </article>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/compro-japan.js') }}"></script>
@endsection
