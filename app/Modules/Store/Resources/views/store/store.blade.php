@extends('layouts.merchants.app')

@section('title', __('store.store'))

@section('body-class', 'body-shop')

@section('footer-class', 'footer-shop')

@section('header')
    @include('store.header')
@endsection

@section('content')
    <!-- Main -->
    <div class="main-shop">
        <!-- Navigate Link -->
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
        </div><!-- /. end navigate link -->

        <!-- Main shop wrapper -->
        <div class="main-shop-wrapper">
            <div class="container main-shop-empty">
                <div class="main-shop-empty__cont">
                    <p>Now you do not have any active ads</p>
                    <a href="#" class=""><i></i>Add New Products</a>
                </div>
            </div>
        </div><!-- /. main shop wrapper -->
    </div><!-- /. end main -->
@endsection