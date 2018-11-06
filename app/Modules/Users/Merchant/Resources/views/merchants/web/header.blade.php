<header class="header">
    <div class="container">
        <div class="header__cont">
            <div class="header__logo">
                <a href="{{route('index')}}">Logotype BTW</a>
            </div>
            <div class="header__info">
                <div class="header__lang">English<span>EN</span></div>
                <nav class="navigation">

                    @if (Route::currentRouteName() !== 'index')
                        <a href="#">{{__('merchants.home')}}</a>
                    @endif

                    <a href="#">{{__('merchants.terms_and_conditions')}}</a>
                </nav>
            </div>
        </div>
    </div>
</header><!-- /. end header -->