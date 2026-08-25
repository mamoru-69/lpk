@extends('layouts.app')

@section('title', 'Lpk Ayumu Kaigo - Beranda')

@section('content')
<section class="hero{{ !empty($settings['hero_background'] ?? null) ? ' has-bg' : '' }}"@if(!empty($settings['hero_background'] ?? null)) style="--hero-bg:url('{{ asset('storage/'.$settings['hero_background']) }}')"@endif>
    <div class="container py-5">
        <div class="row align-items-center min-vh-75 g-5">
            <div class="col-lg-7">
                <span class="eyebrow hero-animate">日本への第一歩 • LANGKAH PERTAMA KE JEPANG</span>
                <h1 class="display-3 fw-bold mt-3 hero-animate delay-1">
                    @if(!empty($settings['hero_title']))
                        {{ $settings['hero_title'] }}
                    @else
                        Bangun Kompetensi.<br><span>Siap Menuju Jepang.</span>
                    @endif
                </h1>
                <p class="lead mt-4 hero-animate delay-2">{{ $settings['hero_subtitle'] ?? 'Program bahasa Jepang, pembekalan budaya kerja, persiapan ujian, dan kesiapan seleksi kerja Jepang dalam satu jalur pembinaan.' }}</p>
                <div class="d-flex gap-3 flex-wrap mt-4 hero-animate delay-3">
                    <a class="btn btn-danger btn-lg" href="{{ route('registration.create') }}">Mulai Pendaftaran</a>
                    <a class="btn btn-outline-light btn-lg" href="{{ route('programs') }}">Lihat Program</a>
                </div>
            </div>
            <div class="col-lg-5 hero-animate delay-4">
                <div class="japan-card">
                    <div class="sun"></div>
                    <h3>準備 • 挑戦 • 成長</h3>
                    <p>Persiapan • Tantangan • Bertumbuh</p>
                    <hr>
                    <div class="row text-center">
                        <div class="col"><strong>N5–N4</strong><small>Bahasa</small></div>
                        <div class="col"><strong>JFT</strong><small>Persiapan</small></div>
                        <div class="col"><strong>SSW</strong><small>Karier</small></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="section-heading text-center reveal">
            <span>PROGRAM UNGGULAN</span>
            <h2>Persiapan Terarah untuk Jepang</h2>
        </div>
        <div class="row g-4 mt-3">
            @forelse($programs as $program)
            <div class="col-md-6 col-lg-4">
                <div class="program-card h-100 reveal reveal-delay-{{ ($loop->index % 3) + 1 }}">
                    <div class="program-icon">日</div>
                    <small>{{ $program->category }}</small>
                    <h4>{{ $program->name }}</h4>
                    <p>{{ $program->short_description }}</p>
                    <a href="{{ route('programs.show', $program) }}">Pelajari program →</a>
                </div>
            </div>
            @empty
            <div class="col-12 text-center reveal">Program belum tersedia.</div>
            @endforelse
        </div>
    </div>
</section>

<section class="why py-5">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-5 reveal">
                <span class="eyebrow dark">KENAPA MEMILIH KAMI</span>
                <h2 class="display-6 fw-bold">Bukan hanya belajar bahasa, tetapi membangun kesiapan.</h2>
            </div>
            <div class="col-lg-7">
                <div class="row g-3">
                    @foreach([
                        ['01', 'Kurikulum Bertahap', 'Dari dasar bahasa hingga kesiapan ujian dan wawancara.'],
                        ['02', 'Budaya Kerja Jepang', 'Pembiasaan disiplin, komunikasi, etika, dan keselamatan kerja.'],
                        ['03', 'Proses Transparan', 'Informasi program, tahapan, dan dokumen dibuat mudah dipahami.'],
                        ['04', 'Pendampingan Kandidat', 'Pemantauan progres peserta hingga tahap seleksi sesuai program.'],
                    ] as $i => $feature)
                    <div class="col-md-6">
                        <div class="feature reveal reveal-delay-{{ ($i % 2) + 1 }}">
                            <b>{{ $feature[0] }}</b>
                            <h5>{{ $feature[1] }}</h5>
                            <p>{{ $feature[2] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="section-heading reveal">
            <span>FAQ</span>
            <h2>Pertanyaan Umum</h2>
        </div>
        <div class="accordion mt-4 reveal" id="faq">
            @foreach($faqs as $faq)
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#f{{ $faq->id }}">{{ $faq->question }}</button>
                </h2>
                <div id="f{{ $faq->id }}" class="accordion-collapse collapse" data-bs-parent="#faq">
                    <div class="accordion-body">{{ $faq->answer }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('js/compro-japan.js') }}"></script>
@endsection
