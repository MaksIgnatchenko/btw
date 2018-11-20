<!-- Navigate Link -->
<div class="top-nav-line">
    <ul class="nav-line__list container">
        <li class="nav-line__item">
            <a href="{{ route('products.index') }}" class="nav-line__link @if ($active === 'products') nav-line__link--active @endif">{{__('store.my_products')}}</a>
        </li>
        <li class="nav-line__item">
            <a href="#" class="nav-line__link @if ($active === 'orders') nav-line__link--active @endif">{{__('store.my_orders')}}</a>
        </li>
        <li class="nav-line__item">
            <a href="{{ route('merchant.settings') }}" class="nav-line__link @if ($active === 'settings') nav-line__link--active @endif">{{__('store.settings')}}</a>
        </li>
    </ul>
</div><!-- /. end navigate link -->
