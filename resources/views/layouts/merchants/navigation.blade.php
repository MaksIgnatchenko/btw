<!-- Navigate Link -->
<div class="top-nav-line">
    <ul class="nav-line__list container">
        <li class="nav-line__item">
            <a href="{{ route('products.index') }}" class="nav-line__link
            @if(isset($active) && $active === 'products')
            {{'nav-line__link--active'}}
            @endif
                    ">{{__('store.my_products')}}</a>
        </li>
        <li class="nav-line__item
        @if(isset($active) && $active === 'orders')
        {{'nav-line__link--active'}}
        @endif
                ">
            <a href="{{ route('web.orders.index') }}" class="nav-line__link">{{__('store.my_orders')}}</a>
        </li>
        <li class="nav-line__item
        @if(isset($active) && $active === 'settings')
        {{'nav-line__link--active'}}
        @endif
                ">
            <a href="{{ route('merchant.settings') }}" class="nav-line__link">{{__('store.settings')}}</a>
        </li>
        <li class="nav-line__item
        @if(isset($active) && $active === 'reviews')
        {{'nav-line__link--active'}}
        @endif
                ">
            <a href="{{ route('reviews.list', ['type' => 'merchant', 'id' => Auth::user()->id]) }}" class="nav-line__link">{{__('store.my_reviews')}}</a>
        </li>
    </ul>
</div><!-- /. end navigate link -->