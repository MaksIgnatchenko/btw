<header class="@isset($header_class) {{$header_class}} @endisset header">
    <div class="container">
        <div class="header__cont">
            <div class="header__logo">
                <a href="{{route('index')}}">Logotype BTW</a>
            </div>
            <div class="header__info">
                <div class="header__lang">English<span>EN</span></div>

                @auth('merchant')
                    @if(Route::currentRouteName() === 'products.index')
                        <div class="header-shop__add">
                            <a href="{{ route('products.create') }}"
                               class="shop-header__btn"><i></i>{{__('store.add_new_products')}}</a>
                        </div>
                    @endif
                    <div class="header-shop__user-info">
                        <div class="user__icon">
                            <figure class="user-icon__figure">
                                <img class="img-fluid" src="{{ $merchant->avatar ?? config('wish.storage.merchants.default_avatar_url') }}" alt="User icon">
                            </figure>
                        </div>
                        <div class="user__name">
                            <span class="user__name__txt">{{ $merchant->fullName }}</span><span
                                    class="user__name__arrow"></span>
                            <div class="user__logout">
                                <a href="{{ route('merchant.logout') }}" class="user__logout__txt"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                            class="user__logout__icon"></i>{{__('store.logout')}}</a>
                                <form id="logout-form" action="{{ route('merchant.logout') }}" method="POST"
                                      style="display: none;">
                                    {!! csrf_field() !!}
                                </form>
                            </div>
                        </div>

                    </div>
                        @if($merchant->isPending())
                            <div class="user__status">
                                <span class="user__status-text">{{__('auth.account_pending')}}</span>
                            </div>
                        @endif
                @endauth

                @guest
                    <nav class="navigation">
                        @if (Route::currentRouteName() !== 'index')
                            <a href="{{ url('products/') }}">{{__('merchants.home')}}</a>
                        @endif

                        <a target="_blank"
                           href="{{ route('merchant.content', ['content' => 'terms_and_conditions']) }}">
                            {{__('merchants.terms_and_conditions')}}
                        </a>
                    </nav>
                @endguest

            </div>
        </div>
    </div>
</header><!-- /. end header -->