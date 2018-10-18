<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Store</title>
    <link rel="stylesheet" href="{{asset('css/merchant-style.css')}}">

    @yield('css')
</head>
<body>
<!-- Header -->
<header class="header">
    <div class="container">
        <div class="header__cont">
            <div class="header__logo">
                <a href="#">Logotype BTW</a>
            </div>
            <div class="header__info">
                <div class="header__lang"><span></span>English</div>
                <nav class="navigation">
                    <a href="#">Home</a>
                    <a href="#">Terms and conditions</a>
                </nav>
            </div>
        </div>
    </div>
</header><!-- /. end header -->

@yield('content');

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <p class="footer__copy">&copy; 2018 Better than Wish</p>
    </div>
</footer><!-- /. footer -->

<script src="{{asset('js/custom.js')}}"></script>
@yield('script')
</body>
</html>