<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', $settings['site_name'] ?? 'Lpk Ayumu Kaigo')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/compro-japan.css') }}">
    <style>
        .swal-theme-popup { border-radius: 20px; }
        .swal-theme-title { font-weight: 800; }
        .swal2-styled.swal2-confirm { border-radius: 10px; font-weight: 700; }
        .swal2-styled.swal2-cancel { border-radius: 10px; font-weight: 700; }
    </style>
</head>
<body>
@php
    $siteName = $settings['site_name'] ?? 'Lpk Ayumu Kaigo';
    $waUrl = \App\Models\Setting::whatsappUrl($settings['whatsapp'] ?? null);
    $currentLocale = app()->getLocale();
    $setting = fn ($key, $default = null) => \App\Models\Setting::localized($settings, $key, $default);
@endphp
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">日の丸 {{ $siteName }}</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
        <div id="nav" class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li><a class="nav-link" href="{{ route('profile') }}">{{ __('app.nav.profile') }}</a></li>
                <li><a class="nav-link" href="{{ route('programs') }}">{{ __('app.nav.programs') }}</a></li>
                <li><a class="nav-link" href="{{ route('legal') }}">{{ __('app.nav.legal') }}</a></li>
                <li><a class="nav-link" href="{{ route('gallery') }}">{{ __('app.nav.gallery') }}</a></li>
                <li><a class="nav-link" href="{{ route('news') }}">{{ __('app.nav.news') }}</a></li>
                <li><a class="nav-link" href="{{ route('faq') }}">{{ __('app.nav.faq') }}</a></li>
                <li><a class="nav-link" href="{{ route('contact') }}">{{ __('app.nav.contact') }}</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('app.nav.language') }}: {{ strtoupper($currentLocale) }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @foreach(['id', 'en', 'ja'] as $locale)
                            <li>
                                <a class="dropdown-item @if($currentLocale === $locale) active @endif" href="{{ route('language.switch', $locale) }}">
                                    {{ __("app.languages.$locale") }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li><a class="btn btn-danger ms-lg-2" href="{{ route('registration.create') }}">{{ __('app.nav.register') }}</a></li>
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<footer class="site-footer mt-5">
    <div class="container">
        <div class="site-footer-main">
            <div class="site-footer-brand">
                <a class="site-footer-logo" href="{{ route('home') }}">
                    <span>LPK</span>
                    <strong>{{ $siteName }}</strong>
                </a>
                <p class="site-footer-tagline">
                    {{ $setting('tagline', __('app.footer.default_tagline')) }}
                </p>
                <a class="site-footer-cta" href="{{ route('registration.create') }}">{{ __('app.footer.register') }}</a>
            </div>

            <div class="site-footer-links">
                <h6 class="site-footer-title">{{ __('app.footer.menu') }}</h6>
                <ul class="list-unstyled mb-0">
                    <li><a href="{{ route('profile') }}">{{ __('app.nav.profile') }}</a></li>
                    <li><a href="{{ route('programs') }}">{{ __('app.nav.programs') }}</a></li>
                    <li><a href="{{ route('legal') }}">{{ __('app.nav.legal') }}</a></li>
                    <li><a href="{{ route('gallery') }}">{{ __('app.nav.gallery') }}</a></li>
                    <li><a href="{{ route('news') }}">{{ __('app.nav.news') }}</a></li>
                    <li><a href="{{ route('contact') }}">{{ __('app.nav.contact') }}</a></li>
                </ul>
            </div>

            <div class="site-footer-contact-wrap">
                <h6 class="site-footer-title">{{ __('app.footer.contact') }}</h6>
                <ul class="site-footer-contact list-unstyled mb-0">
                    @if(!empty($settings['address']))
                        <li><span>AL</span> <p>{{ $settings['address'] }}</p></li>
                    @endif
                    @if($waUrl)
                        <li><span>WA</span> <p><a href="{{ $waUrl }}" target="_blank" rel="noopener">WhatsApp {{ $settings['whatsapp'] }}</a></p></li>
                    @elseif(!empty($settings['whatsapp']))
                        <li><span>WA</span> <p>{{ $settings['whatsapp'] }}</p></li>
                    @endif
                    @if(!empty($settings['phone']))
                        <li><span>TL</span> <p><a href="tel:{{ preg_replace('/\s+/', '', $settings['phone']) }}">{{ $settings['phone'] }}</a></p></li>
                    @endif
                    @if(!empty($settings['email']))
                        <li><span>EM</span> <p><a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a></p></li>
                    @endif
                </ul>
            </div>

            <div class="site-footer-location">
                @if(!empty($settings['map_embed']))
                    <h6 class="site-footer-title">{{ __('app.footer.location') }}</h6>
                    <div class="site-footer-map">
                        <iframe src="{{ $settings['map_embed'] }}" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
                    </div>
                @endif
            </div>
        </div>

        <div class="site-footer-bottom">
            <small>&copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.</small>
            <small>{{ __('app.footer.career') }}</small>
        </div>
    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@include('components.sweetalert')
@yield('scripts')
</body>
</html>
