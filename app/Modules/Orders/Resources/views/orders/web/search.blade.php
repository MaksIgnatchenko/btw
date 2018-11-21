<form class="shop-top-settings__form" action="{{ route('orders.search') }}" name="orders-search">
    <span class="search-icon">{{ __('search.search_icon') }}</span>
    <input type="search" name="search" placeholder="{{ __('search.search_input_placeholder') }}" value="{{ $searchText ?? null }}" maxlength="{{ config('wish.orders.search_max_length') }}">
</form>