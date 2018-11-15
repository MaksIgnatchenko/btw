<div class="shop-top-settings">

    @include('products.web.search')

    @if(!ProductsViewHelper::isSearchResults() || !$products->isEmpty())
        <div class="shop-top-settings__change">
            <a href="?template={{ ProductsViewTemplateEnum::GALLERY }}&page={{ $products->currentPage() }}{{ null !== (request()->get('search')) ? '&search=' . request()->get('search') : '' }}"{{ ProductsViewHelper::checkTemplate(ProductsViewTemplateEnum::GALLERY) ? "class=change-active" :  ''}}>{{ __('store.view_gallery') }}</a>
            <a href="?template={{ ProductsViewTemplateEnum::LIST }}&page={{ $products->currentPage() }}{{ null !== (request()->get('search')) ? '&search=' . request()->get('search') : '' }}"{{ ProductsViewHelper::checkTemplate(ProductsViewTemplateEnum::LIST) ? "class=change-active" :  ''}}>{{ __('store.view_list') }}</a>
        </div>
    @endif
</div>