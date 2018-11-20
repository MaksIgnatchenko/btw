<form class="shop-top-settings__form" action="{{ route('products.search') }}" method="get" name="product-search">
    <span class="search-icon">{{ __('search.search_icon') }}</span>
    <input type="search" name="search" placeholder="{{ __('search.search_input_placeholder') }}">
</form>