<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical"
      data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover"
      data-sidebar-image="none">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" x-bind:content="description">
    <meta name="keywords" x-bind:content="keywords">
    <meta name="author" x-bind:content="author">
    <title x-text="title">{{ $title ?? 'Login' }}</title>

    <link rel="shortcut icon" href="{{ url('assets/images/logo.png') }}">
    <script src="{{ url('assets/js/layout.js') }}"></script>
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    @livewireStyles
</head>

<body>
<div class="auth-page-wrapper pt-5">
    <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
        <div class="bg-overlay"></div>

        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div>

    {{ $slot }}

    <footer class="footer start-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0 text-muted">&copy;
                            Mohammed. Crafted with <i class="mdi mdi-heart text-danger"></i> by ali
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<script src="{{ url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ url('assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ url('assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ url('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>

@stack('scripts')
@livewireScripts
</body>
</html>
