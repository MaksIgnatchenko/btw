<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/merchants/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/merchants/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    @yield('css')
</head>
<body class="@yield('body-class')">
<!-- Header -->
@yield('header')

@yield('content')

<!-- Footer -->
@section('footer')
<footer class="@yield('footer-class')">
    <div id="configs">
        @each('layouts.merchants.configs', $configs, 'configs')
    </div>
    <div class="container">
        <p class="footer__copy">&copy; {{date('Y')}} SkyCart</p>
    </div>
</footer><!-- /. footer -->
@show

<script src="{{asset('js/wish.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('js/loading.js')}}"></script>
@yield('script')
</body>
</html>