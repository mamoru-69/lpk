@extends('layouts.app')

@section('title', 'Pendaftaran')

@section('content')
<section class="page-head">
    <div class="container page-head-inner">
        <span>REGISTRATION</span>
        <h1>{{ __('app.registration.title') }}</h1>
        <p class="mb-0 opacity-75">{{ __('app.registration.subtitle') }}</p>
    </div>
</section>

<div class="container py-5">
    <div class="form-shell">
        <form method="POST" action="{{ route('registration.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label>{{ __('app.registration.name') }} *</label>
                    <input class="form-control" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-6">
                    <label>{{ __('app.registration.phone') }} *</label>
                    <input class="form-control" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx" required>
                </div>
                <div class="col-md-6">
                    <label>{{ __('app.registration.nik') }} *</label>
                    <input class="form-control" name="nik" value="{{ old('nik') }}" required>
                </div>
                <div class="col-md-3">
                    <label>{{ __('app.registration.birth_place') }} *</label>
                    <input class="form-control" name="birth_place" value="{{ old('birth_place') }}" required>
                </div>
                <div class="col-md-3">
                    <label>{{ __('app.registration.birth_date') }} *</label>
                    <input type="date" class="form-control" name="birth_date" value="{{ old('birth_date') }}" required>
                </div>
                <div class="col-md-4">
                    <label>{{ __('app.registration.gender') }} *</label>
                    <select class="form-select" name="gender" required>
                        <option value="">{{ __('app.registration.select') }}</option>
                        <option value="L" @selected(old('gender') === 'L')>{{ __('app.registration.male') }}</option>
                        <option value="P" @selected(old('gender') === 'P')>{{ __('app.registration.female') }}</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>{{ __('app.registration.education') }} *</label>
                    <input class="form-control" name="education" value="{{ old('education') }}" placeholder="{{ __('app.registration.education_placeholder') }}" required>
                </div>
                <div class="col-md-4">
                    <label>{{ __('app.registration.japanese_level') }} *</label>
                    <select class="form-select" name="japanese_level" required>
                        <option value="">{{ __('app.registration.select_level') }}</option>
                        @foreach(['none' => 'Belum pernah belajar', 'n5' => 'N5', 'n4' => 'N4', 'n3' => 'N3 atau lebih'] as $key => $level)
                            <option value="{{ $level }}" @selected(old('japanese_level') === $level)>{{ __("app.registration.levels.$key") }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label>{{ __('app.registration.program') }} *</label>
                    <select class="form-select" name="program_id" required>
                        <option value="">{{ __('app.registration.select_program') }}</option>
                        @foreach($programs as $p)
                            <option value="{{ $p->id }}" @selected(old('program_id') == $p->id)>{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label>{{ __('app.registration.email') }} *</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="col-12">
                    <label>{{ __('app.registration.address') }} *</label>
                    <textarea class="form-control" name="address" rows="3" required>{{ old('address') }}</textarea>
                </div>

                <div class="col-12"><hr><h5 class="mb-0">{{ __('app.registration.documents') }} *</h5></div>

                <div class="col-md-4">
                    <label>{{ __('app.registration.photo') }} *</label>
                    <input class="form-control" type="file" name="photo" accept=".jpg,.jpeg,.png" required>
                    <small class="text-muted">{{ __('app.registration.image_hint') }}</small>
                </div>
                <div class="col-md-4">
                    <label>{{ __('app.registration.ktp') }} *</label>
                    <input class="form-control" type="file" name="ktp" accept=".jpg,.jpeg,.png,.pdf" required>
                    <small class="text-muted">{{ __('app.registration.file_hint') }}</small>
                </div>
                <div class="col-md-4">
                    <label>{{ __('app.registration.ijazah') }} *</label>
                    <input class="form-control" type="file" name="ijazah" accept=".jpg,.jpeg,.png,.pdf" required>
                    <small class="text-muted">{{ __('app.registration.file_hint') }}</small>
                </div>

                <div class="col-12">
                    <button class="btn btn-danger btn-lg">{{ __('app.registration.submit') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/compro-japan.js') }}"></script>
@endsection
