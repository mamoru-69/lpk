@extends('layouts.admin')

@section('content')
<div class="admin-page-head">
    <div>
        <h2>{{ $registration->name }}</h2>
        <div class="mt-2">@include('components.admin.status-badge', ['status' => $registration->status, 'label' => $registration->statusLabel()])</div>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ $registration->whatsappUrl() }}" target="_blank" rel="noopener" class="admin-btn">💬 Chat WhatsApp</a>
        <a href="{{ route('admin.registrations.index') }}" class="admin-btn admin-btn-outline">← Kembali</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="admin-card mb-4">
            <h5 class="mb-3">Program & Kontak</h5>
            <div class="admin-info-grid">
                <div class="admin-info-item">
                    <small>Program Diminati</small>
                    <strong>{{ $registration->program?->name ?? 'Tidak ada program' }}</strong>
                    @if($registration->program?->category)
                        <span class="text-muted d-block">{{ $registration->program->category }}</span>
                    @endif
                </div>
                <div class="admin-info-item">
                    <small>WhatsApp</small>
                    <a href="{{ $registration->whatsappUrl() }}" target="_blank" rel="noopener" class="admin-wa-link">
                        {{ $registration->phone }} ↗
                    </a>
                </div>
                <div class="admin-info-item">
                    <small>Email</small>
                    <strong>{{ $registration->email ?: '-' }}</strong>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <h5 class="mb-3">Data Pendaftar</h5>
            <p><b>NIK:</b> {{ $registration->nik ?: '-' }}</p>
            <p><b>Tempat, Tanggal Lahir:</b> {{ $registration->birth_place ?: '-' }}{{ $registration->birth_date ? ', '.$registration->birth_date->format('d/m/Y') : '' }}</p>
            <p><b>Jenis Kelamin:</b> {{ $registration->gender === 'L' ? 'Laki-laki' : ($registration->gender === 'P' ? 'Perempuan' : '-') }}</p>
            <p><b>Pendidikan:</b> {{ $registration->education ?: '-' }}</p>
            <p><b>Level Jepang:</b> {{ $registration->japanese_level ?: '-' }}</p>
            <p><b>Alamat:</b> {{ $registration->address ?: '-' }}</p>
            <p class="mb-0"><b>Daftar pada:</b> {{ $registration->created_at?->format('d F Y H:i') }}</p>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="admin-card mb-4">
            <h5 class="mb-3">Dokumen</h5>
            <div class="admin-doc-list">
                @foreach([
                    'photo' => 'Pas Foto',
                    'ktp' => 'KTP',
                    'ijazah' => 'Ijazah',
                ] as $field => $label)
                    @php $path = $registration->{$field}; @endphp
                    <div class="admin-doc-item">
                        <div>
                            <strong>{{ $label }}</strong>
                            @if($path)
                                <small class="d-block text-muted">{{ strtoupper(pathinfo($path, PATHINFO_EXTENSION)) }}</small>
                            @endif
                        </div>
                        @if($path)
                            <a href="{{ asset('storage/'.$path) }}" target="_blank" rel="noopener" class="admin-link">Lihat</a>
                        @else
                            <span class="text-muted">Belum ada</span>
                        @endif
                    </div>
                    @if($path && in_array(strtolower(pathinfo($path, PATHINFO_EXTENSION)), ['jpg','jpeg','png']))
                        <img src="{{ asset('storage/'.$path) }}" alt="{{ $label }}" class="admin-doc-preview mb-3">
                    @endif
                @endforeach
            </div>
        </div>

        <div class="admin-card admin-form">
            <h5 class="mb-3">Update Proses</h5>
            <p class="text-muted small">Ubah status setelah menghubungi atau memproses pendaftar.</p>

            <form method="POST" action="{{ route('admin.registrations.update', $registration) }}">
                @csrf
                @method('PUT')

                <label>Status</label>
                <select class="form-select" name="status">
                    @foreach(\App\Models\Registration::STATUSES as $key => $label)
                        <option value="{{ $key }}" @selected($registration->status === $key)>{{ $label }}</option>
                    @endforeach
                </select>

                <label>Catatan internal</label>
                <textarea class="form-control" rows="5" name="notes" placeholder="Contoh: Sudah di-WA tanggal 25/08, jadwalkan wawancara minggu depan.">{{ $registration->notes }}</textarea>

                <button class="admin-btn mt-2">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection
