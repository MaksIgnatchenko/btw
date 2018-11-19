@extends('layouts.merchants.app')

@section('title', __('store.store'))

@section('body-class', 'body-shop')

@section('footer-class', 'footer-shop')

@section('header')
    @include('layouts.merchants.header', ['header_class' => 'header-black'])
@endsection

@section('script')
    <script src="{{asset('vendor/Image-PDF-Viewer-EZView/EZView.js')}}"></script>
    <script src="{{asset('js/merchants/products/ezview.js')}}"></script>
@endsection

@section('content')
    <!-- Main -->
    <div class="main-shop">

    @include('layouts.merchants.navigation', ['active' => 'products'])

    <!-- Main shop wrapper -->
        <div class="main-shop-wrapper">
            <div class="container">

                <div class="edit-title__container">
                    <h1 class="edit-title">{{ $product->name }}</h1>
                    <div class="edit-price">${{ $product->price }}</div>
                </div>

                <hr class="form-hr">

                <div class="edit-wrapper">
                    <h3 class="edit-title-min">{{$product->category->name}}</h3>
                    <ul class="edit-gallery">
                        <li class="edit-item">
                            <img class="img__gallery" src="{{ $product->main_image }}" alt="edit pic">
                        </li>
                        @foreach ($product->images as $image)
                        <li class="edit-item">
                            <img class="img__gallery" src="{{ $image->image }}" alt="edit pic">
                        </li>
                        @endforeach
                    </ul>
                    <p class="edit-text">{{ $product->description }}</p>
                    <p class="edit-attr__head">Product's attributes</p>
                    <hr class="form-hr">
                    <div class="edit-attr__wrapper">
                        <div class="edit-attr__line">
                            <div class="edit-attr__title">Quantity</div>
                            <div class="edit-attr__descr">{{ $product->quantity }}</div>
                        </div>
                        @foreach ($product->attributes as $name => $attribute)
                            <div class="edit-attr__line">
                                <div class="edit-attr__title">{{ $name }}</div>
                                <div class="edit-attr__descr">{{ $attribute['value'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="t-a-center edit-bottom-m">
                    <a class="btn" href="{{ route('products.edit', ['product' => $product]) }}">{{ __('products.edit') }}</a>
                </div>

            </div>
        </div><!-- /. main shop wrapper -->
    </div><!-- /. end main -->
@endsection