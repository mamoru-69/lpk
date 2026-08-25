@php
    $type = $type ?? 'text';
    $rows = $rows ?? 3;
    $placeholder = $placeholder ?? '';
    $locales = [
        '' => 'Indonesia',
        '_en' => 'English',
        '_ja' => 'Jepang',
    ];
@endphp

<div class="admin-localized-field">
    <label>{{ $label }}</label>
    <div class="admin-localized-grid">
        @foreach($locales as $suffix => $localeLabel)
            @php $fieldName = $name.$suffix; @endphp
            <div>
                <small>{{ $localeLabel }}</small>
                @if($type === 'textarea')
                    <textarea class="form-control" rows="{{ $rows }}" name="{{ $fieldName }}" placeholder="{{ $placeholder }}">{{ $settings[$fieldName] ?? '' }}</textarea>
                @else
                    <input class="form-control" name="{{ $fieldName }}" value="{{ $settings[$fieldName] ?? '' }}" placeholder="{{ $placeholder }}">
                @endif
            </div>
        @endforeach
    </div>
</div>
