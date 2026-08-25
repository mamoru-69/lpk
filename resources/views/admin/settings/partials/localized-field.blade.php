@php
    $type = $type ?? 'text';
    $rows = $rows ?? 3;
    $placeholder = $placeholder ?? '';
@endphp

<div class="admin-localized-field">
    <label>{{ $label }}</label>
    @if($type === 'textarea')
        <textarea class="form-control" rows="{{ $rows }}" name="{{ $name }}" placeholder="{{ $placeholder }}">{{ $settings[$name] ?? '' }}</textarea>
    @else
        <input class="form-control" name="{{ $name }}" value="{{ $settings[$name] ?? '' }}" placeholder="{{ $placeholder }}">
    @endif
</div>
