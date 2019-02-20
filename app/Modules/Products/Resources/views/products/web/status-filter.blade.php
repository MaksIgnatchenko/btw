<form class="shop-top-filter__form" action="{{route('products.index')}}" method="GET" name="product-filter">
    <div class="shop-top-settings__change form-item__wrapper">
        <div class="custom-select">
            {{ Form::select('filter[product-status]', ['Select', 'all' => 'All'] + ProductStatusEnum::toArray(), ProductStatusEnum::ACTIVE) }}
        </div>
    </div>
</form>