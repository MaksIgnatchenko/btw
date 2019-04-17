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
@guest
<script>
    window.intercomSettings = {
        app_id: "{{config('services.intercom.app_id')}}"
    };
</script>
<script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/e8aufejb';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
@endguest
@auth('merchant')
<script>
    @php
        $merchant = Auth::user();
    @endphp
    window.intercomSettings = {
        app_id: "{{config('services.intercom.app_id')}}",
        name: "{{$merchant->full_name}}", // Full name
        email: "{{$merchant->email}}", // Email address
        created_at:"{{$merchant->created_at}}",// Signup date as a Unix timestamp
        avatar: {
            "avatar" : "avatar",
            'image_url' : "{{asset($merchant->avatar ?? config('wish.storage.merchants.default_avatar_url'))}}"
        }
    };
</script>
<script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/e8aufejb';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
@endauth
</body>
</html>