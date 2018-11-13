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

            <div class="container main-shop-empty">
                <div class="main-shop-empty__cont">
                    <p>{{__('store.no_active_ads')}}</p>
                    <a href="{{ route('products.create') }}" class=""><i></i>{{__('store.add_new_products')}}</a>
                </div>
            </div>
        </div><!-- /. main shop wrapper -->
    </div><!-- /. end main -->
@endsection