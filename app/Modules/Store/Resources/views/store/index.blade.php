@extends('store.app)
@section('title', 'Store')
@section('body')
    <body class="body-shop">
    @include('store.header')
    <div class="main-shop">

        <div class="top-nav-line">
            <ul class="nav-line__list">
                <li class="nav-line__item">
                    <a href="#" class="nav-line__link nav-line__link--active">My Products</a>
                </li>
                <li class="nav-line__item">
                    <a href="#" class="nav-line__link">My orders</a>
                </li>
                <li class="nav-line__item">
                    <a href="#" class="nav-line__link">Settings</a>
                </li>
            </ul>
        </div>

        <div class="main-shop-wrapper">
            <div class="container main-shop-empty">
                <div class="main-shop-empty__cont">
                    <p>Now you do not have any active ads</p>
                    <a href="#" class=""><i></i>Add New Products</a>
                </div>
            </div>
        </div>
    </div>
    @include('store.footer')
@endsection