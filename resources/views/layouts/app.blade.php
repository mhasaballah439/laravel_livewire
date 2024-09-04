<!doctype html>
<html lang="{{Illuminate\Support\Facades\Lang::getLocale() == 'ar' ? 'ar' : 'en'}}"
      dir="{{Illuminate\Support\Facades\Lang::getLocale() == 'ar' ? 'rtl' : 'ltr'}}" data-layout="vertical"
      data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover"
      data-sidebar-image="none">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" x-bind:content="description">
    <meta name="keywords" x-bind:content="keywords">
    <meta name="author" x-bind:content="author">
    <title x-text="title">{{ $title ?? 'Dashboard' }}</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}">
    <script src="{{ asset('assets/js/layout.js') }}"></script>

    @if(Illuminate\Support\Facades\Lang::getLocale() == 'en')
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    @else
        <link href="{{ asset('assets/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css" />
    @endif
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    @if(Illuminate\Support\Facades\Lang::getLocale() == 'en')
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />

    @else
        <link href="{{ asset('assets/css/app-rtl.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/custom-rtl.min.css') }}" rel="stylesheet" type="text/css" />
    @endif

    @stack('styles')
</head>

<body>
<div id="layout-wrapper">
    <livewire:dashboard.app.header/>

    <livewire:dashboard.app.sidebar/>

    <div class="main-content">
        <div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show" role="alert">
            <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Label icon arrow  alert
        </div>
        {{ $slot }}

        <footer class="footer">
            <livewire:dashboard.app.footer/>
        </footer>
    </div>
</div>

<livewire:dashboard.app.app-menue/>

<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
@stack('scripts')
</body>
</html>
