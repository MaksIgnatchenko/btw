<li class="product__item">
    <section class="product__card">
        <figure class="product__card__fig">
            <img src="{{ $product->main_image }}" alt="product">
        </figure>
        <div class="product__card__info">
            <h3 class="product__card__title">{{ $product->name }}</h3>
            @if(ProductsViewHelper::checkTemplate(ProductsViewTemplateEnum::LIST))
                <p class="product__card__descr">{{ $product->description }}</p>
            @endif
            <p class="product__card__price"><span>$</span>{{ $product->price }}</p>
        </div>
        <div class="product__card__link-wr">
            <a href="#" class="product__card__link">{{ __('store.product_info_text') }}</a>
        </div>
    </section>
</li>