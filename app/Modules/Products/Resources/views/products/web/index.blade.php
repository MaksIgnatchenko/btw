@extends('layouts.merchants.app')

@section('title', __('store.store'))

@section('body-class', 'body-shop')

@section('footer-class', 'footer-shop')

@section('header')
    @include('layouts.merchants.header', ['header_class' => 'header-black'])
@endsection

@section('content')
    <!-- Main -->
    <div class="main-shop">

    @include('layouts.merchants.navigation', ['active' => 'products'])

        <!-- Main shop wrapper -->
        <div class="main-shop-wrapper">

            @include('flash::message')

            <div class="container {{ $products->isEmpty() && !ProductsViewHelper::isSearchResults() ? 'main-shop-empty' : ''}}">
                @if($products->isEmpty())
                    @if(ProductsViewHelper::isSearchResults())
                        @include('products.web.store-navigation')
                        @include('products.web.search-empty')
                    @else
                        @include('products.web.shop-empty')
                    @endif
                @else
                    @include('products.web.store-navigation')
                    @include('products.web.product-list')
                    {{ $products->appends(['search' => request()->get('search')])->links() }}
                @endif
            </div>
        </div><!-- /. main shop wrapper -->
    </div><!-- /. end main -->
@endsection