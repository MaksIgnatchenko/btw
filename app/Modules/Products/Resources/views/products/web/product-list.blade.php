<ul class="product__list {{ProductsViewHelper::checkTemplate(ProductsViewTemplateEnum::LIST) ? 'product__list--horizontal' : ''}}">
    @foreach($products as $product)
        @include('products.web.product', ['product' => $product])
    @endforeach
</ul><!-- /. end product list -->