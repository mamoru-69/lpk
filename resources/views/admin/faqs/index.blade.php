@extends('layouts.admin')

@section('content')
<div class="admin-page-head">
    <h2>FAQ</h2>
    <a href="{{ route('admin.faqs.create') }}" class="admin-btn">+ Tambah FAQ</a>
</div>

<div class="admin-card">
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Pertanyaan</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $f)
                <tr>
                    <td>{{ $f->question }}</td>
                    <td><a href="{{ route('admin.faqs.edit', $f) }}" class="admin-link">Edit</a></td>
                </tr>
                @empty
                <tr><td colspan="2">Belum ada FAQ.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
