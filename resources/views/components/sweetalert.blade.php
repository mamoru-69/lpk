@php
    $flashMessages = array_filter([
        'success' => session('success'),
        'error' => session('error'),
        'warning' => session('warning'),
        'info' => session('info'),
        'errors' => isset($errors) && $errors->any() ? $errors->all() : null,
    ], fn ($value) => ! empty($value));
@endphp

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.__flashMessages = @json((object) $flashMessages);
</script>
<script src="{{ asset('js/flash-alerts.js') }}"></script>
