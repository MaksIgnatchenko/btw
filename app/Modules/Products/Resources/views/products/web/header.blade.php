<header class="header-shop">
    <div class="container">
        <div class="header-shop__cont">
            <div class="header__logo">
                <a href="{{ route('products.index') }}">Logotype BTW</a>
            </div>
            <div class="header-shop__info">
                <div class="header__lang">English<span>EN</span></div>

                @if(Route::currentRouteName() !== 'products.create')
                <div class="header-shop__add">
                    <a href="{{ route('products.create') }}" class="shop-header__btn"><i></i>{{__('store.add_new_products')}}</a>
                </div>
                @endif

                <div class="header-shop__user-info">
                    <div class="user__icon">
                        <figure class="user-icon__figure">
                            <img src="{{asset('img/user-icon.png')}}" alt="User icon">
                        </figure>
                    </div>
                    <div class="user__name">
                        <span class="user__name__txt">{{ $merchant->fullName }}</span><span class="user__name__arrow"></span>
                        <div class="user__logout">
                            <a href="{{ route('merchant.logout') }}" class="user__logout__txt" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="user__logout__icon"></i>{{__('store.logout')}}</a>
                            <form id="logout-form" action="{{ route('merchant.logout') }}" method="POST" style="display: none;">
                                {!! csrf_field() !!}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header><!-- /. end header -->