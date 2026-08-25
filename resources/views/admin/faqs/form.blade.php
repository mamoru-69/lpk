@extends('layouts.admin')

@section('content')
<div class="admin-page-head">
    <h2>FAQ</h2>
</div>

<form class="admin-card admin-form" method="POST" action="{{ $faq->exists ? route('admin.faqs.update', $faq) : route('admin.faqs.store') }}">
    @csrf
    @if($faq->exists)
        @method('PUT')
    @endif

    <label>Pertanyaan</label>
    <input class="form-control" name="question" value="{{ old('question', $faq->question) }}">

    <label>Jawaban</label>
    <textarea class="form-control" rows="5" name="answer">{{ old('answer', $faq->answer) }}</textarea>

    <input type="hidden" name="is_active" value="0">
    <label class="d-block mb-3"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $faq->is_active ?? true))> Aktif</label>

    <button class="admin-btn">Simpan FAQ</button>
</form>
@endsection
