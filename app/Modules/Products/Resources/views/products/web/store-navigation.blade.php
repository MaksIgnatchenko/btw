<div class="shop-top-settings">

    @include('products.web.search')

    @if(!ProductsViewHelper::isSearchResults() || !$products->isEmpty())
        <div class="shop-top-settings__change">
            <a href="{{ ProductsViewHelper::getViewTemplateSwitcherLink(ProductsViewTemplateEnum::GALLERY, $products) }}"{{ ProductsViewHelper::getTemplateSwitcherClass(ProductsViewTemplateEnum::GALLERY) }}>{{ __('store.view_gallery') }}</a>
            <a href="{{ ProductsViewHelper::getViewTemplateSwitcherLink(ProductsViewTemplateEnum::LIST, $products) }}"{{ ProductsViewHelper::getTemplateSwitcherClass(ProductsViewTemplateEnum::LIST) }}>{{ __('store.view_list') }}</a>
        </div>
    @endif
</div>