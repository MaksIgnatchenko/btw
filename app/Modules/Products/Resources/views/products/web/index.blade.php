@extends('layouts.merchants.app')

@section('title', __('store.store'))

@section('body-class', 'body-shop')

@section('footer-class', 'footer-shop')

@section('header')
    @include('products.web.header')
@endsection

@section('content')
    <!-- Main -->
    <div class="main-shop">

    @include('products.web.navigation')

        <!-- Main shop wrapper -->
        <div class="main-shop-wrapper">

            @include('flash::message')

            <div class="container {{ $products->isEmpty() ? 'main-shop-empty' : ''}}">
                @if($products->isEmpty())
                    @include('products.web.shop-empty')
                @else
                    @include('products.web.store-navigation')
                    @include('products.web.product-list')
                    {{ $products->appends(['template' => ProductsViewHelper::getTemplate()])->links() }}
                @endif
            </div>
        </div><!-- /. main shop wrapper -->
    </div><!-- /. end main -->
@endsection