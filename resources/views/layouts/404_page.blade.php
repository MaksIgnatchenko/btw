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

    <title>{{ __('admin.404_page.title') }}</title>

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <link href="{{ asset('assets/admin/' . config('admin.main.thema_color') . '/css/bootstrap.min.css') }}"
          rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/' . config('admin.main.thema_color') . '/css/icons.css') }}" rel="stylesheet"
          type="text/css">
    <link href="{{ asset('assets/admin/' . config('admin.main.thema_color') . '/css/style.css') }}" rel="stylesheet"
          type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"
          type="text/css">
</head>
<body class="fixed-left">
<!-- Begin page -->
    <div class="accountbg"></div>
    <div class="wrapper-page">

        <div class="card">
            <div class="card-body">

                <div class="ex-page-content text-center">
                    <h1 class="">404!</h1>
                    <h3 class="">{{ __('admin.404_page.error') }}</h3><br>

                    <a class="btn btn-primary mb-5 waves-effect waves-light" href="{{ route('admin') }}">{{ __('admin.404_page.back') }}</a>
                </div>

            </div>
        </div>
    </div>
</body>
</html>