@extends('store.app)
@section('title', __('store.store'))
@section('body')
    <body class="body-shop">
    @include('store.header')
    <div class="main-shop">

        <div class="top-nav-line">
            <ul class="nav-line__list">
                <li class="nav-line__item">
                    <a href="#" class="nav-line__link nav-line__link--active">{{__('store.my_products')}}</a>
                </li>
                <li class="nav-line__item">
                    <a href="#" class="nav-line__link">{{__('store.my_orders')}}</a>
                </li>
                <li class="nav-line__item">
                    <a href="#" class="nav-line__link">{{__('store.settings')}}</a>
                </li>
            </ul>
        </div>

        <div class="main-shop-wrapper">
            <div class="container main-shop-empty">
                <div class="main-shop-empty__cont">
                    <p>{{__('store.no_active_ads')}}</p>
                    <a href="#" class=""><i></i>{{__('store.add_new_products')}}</a>
                </div>
            </div>
        </div>
    </div>
    @include('store.footer')
@endsection