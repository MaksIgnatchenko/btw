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

    @include('layouts.merchants.navigation', ['active' => 'orders'])

    <!-- Main shop wrapper -->
        <div class="main-shop-wrapper">
            <div class="container">

                @if(!$orders->isEmpty() || OrderViewHelper::isSearchResults())
                    <div class="shop-top-settings">

                        @include('orders.web.search')

                    </div>
                @endif

                @include('flash::message')

                @include('orders.web.orders-table')

                {{ $orders->appends(['search' => request()->get('search')])->links() }}

            </div>
        </div><!-- /. main shop wrapper -->
    </div><!-- /. end main -->
@endsection