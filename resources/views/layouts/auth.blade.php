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

    @section('style')
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

        <link href="{{ asset('assets/admin/' . config('admin.main.thema_color') . '/css/bootstrap.min.css') }}"
              rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/admin/' . config('admin.main.thema_color') . '/css/icons.css') }}" rel="stylesheet"
              type="text/css">
        <link href="{{ asset('assets/admin/' . config('admin.main.thema_color') . '/css/style.css') }}" rel="stylesheet"
              type="text/css">
    @show
</head>

<body>

<!-- Begin page -->
<div class="accountbg"></div>
<div class="wrapper-page">

    <div class="card">
        <div class="card-block">

            <h3 class="text-center mt-0 m-b-15">
                <a href="javascript:void(0);" class="logo logo-admin"><img src="{{ asset('assets/images/logo.png') }}"
                                                                           height="54" alt="logo"></a>
            </h3>

            @yield('content')

        </div>
    </div>
</div>

@section('script')
    <!-- jQuery  -->
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

    <!-- App js -->
    <script src="{{ asset('assets/admin/' . config('admin.main.thema_color') . '/js/app.js') }}"></script>
@show
</body>
</html>