@php
    $classes = [
        'baru' => 'status-baru',
        'dihubungi' => 'status-dihubungi',
        'seleksi' => 'status-seleksi',
        'lulus' => 'status-lulus',
        'ditolak' => 'status-ditolak',
        'berangkat' => 'status-berangkat',
    ];
@endphp
<span class="admin-badge status-badge {{ $classes[$status] ?? '' }}">{{ $label ?? $status }}</span>
