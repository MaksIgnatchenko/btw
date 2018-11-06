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

    @include('flash::message')

        <!-- Main shop wrapper -->
        <div class="main-shop-wrapper">
            <div class="container main-shop-empty">
                <div class="main-shop-empty__cont">
                    <p>{{__('store.no_active_ads')}}</p>
                    <a href="{{ route('products.create') }}" class=""><i></i>{{__('store.add_new_products')}}</a>
                </div>
            </div>
        </div><!-- /. main shop wrapper -->
    </div><!-- /. end main -->
@endsection