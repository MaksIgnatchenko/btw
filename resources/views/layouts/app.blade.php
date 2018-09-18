<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="Admin Dashboard" name="description"/>
    <meta content="ThemeDesign" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <link href="{{ asset('assets/admin/' . config('admin.main.thema_color') . '/css/bootstrap.min.css') }}"
          rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/' . config('admin.main.thema_color') . '/css/icons.css') }}" rel="stylesheet"
          type="text/css">
    <link href="{{ asset('assets/admin/' . config('admin.main.thema_color') . '/css/style.css') }}" rel="stylesheet"
          type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"
          type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    @yield('css')

</head>

<body class="fixed-left">

<div id="preloader">
    <div id="status">
        <div class="spinner"></div>
    </div>
</div>

<div id="wrapper">
    @include('layouts.sidebar')

    <div class="content-page">
        <div class="content">
            @include('layouts.topbar')

            <div class="page-content-wrapper ">

                <div class="container">

                    @yield('content')

                </div>

            </div>

        </div>

        <footer class="footer">
            © 2018 Tech Talk
        </footer>

    </div>

</div>

<script src="{{ asset('assets/admin/' . config('admin.main.thema_color') . '/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/' . config('admin.main.thema_color') . '/js/tether.min.js') }}"></script>
<!-- Tether for Bootstrap -->
<script src="{{ asset('assets/admin/' . config('admin.main.thema_color') . '/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/admin/' . config('admin.main.thema_color') . '/js/modernizr.min.js') }}"></script>
<script src="{{ asset('assets/admin/' . config('admin.main.thema_color') . '/js/detect.js') }}"></script>
<script src="{{ asset('assets/admin/' . config('admin.main.thema_color') . '/js/fastclick.js') }}"></script>
<script src="{{ asset('assets/admin/' . config('admin.main.thema_color') . '/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/admin/' . config('admin.main.thema_color') . '/js/jquery.blockUI.js') }}"></script>
<script src="{{ asset('assets/admin/' . config('admin.main.thema_color') . '/js/waves.js') }}"></script>
<script src="{{ asset('assets/admin/' . config('admin.main.thema_color') . '/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('assets/admin/' . config('admin.main.thema_color') . '/js/jquery.scrollTo.min.js') }}"></script>

<script src="{{ asset('assets/admin/' . config('admin.main.thema_color') . '/js/app.js') }}"></script>

<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/js/app.min.js"></script>

@yield('script')

</body>
</html>