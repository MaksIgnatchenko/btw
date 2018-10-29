<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/merchants/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/merchants/app.css')}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    @yield('css')
</head>
<body>
<!-- Header -->
<header class="header">
    <div class="container">
        <div class="header__cont">
            <div class="header__logo">
                <a href="{{route('index')}}">Logotype BTW</a>
            </div>
            <div class="header__info">
                <div class="header__lang"><span>EN</span>English</div>
                <nav class="navigation">
                    <a href="#">{{__('merchants.home')}}</a>
                    <a href="#">{{__('merchants.terms_and_conditions')}}</a>
                </nav>
            </div>
        </div>
    </div>
</header><!-- /. end header -->

@yield('content')

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <p class="footer__copy">&copy; {{date('Y')}} Better than Wish</p>
    </div>
</footer><!-- /. footer -->

<script src="{{asset('js/wish.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
@yield('script')
</body>
</html>