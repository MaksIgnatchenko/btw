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
                    <div class="edit-price">{{__('products.price')}} ${{ $product->price }}</div>
                </div>

                <div class="edit-delivery-price">
                    {{__('products.delivery_price')}} ${{ $product->delivery_price }}
                </div>

                <hr class="form-hr">
                <!-- Rating section -->
                <div class="rating-wr rating-wr--edit">
                    <div class="rating__grade">
                        {{$product->rating}}
                    </div>
                    @include('reviews.web.rating', ['owner' => $product])
                </div><!-- /. end rating section -->
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
                    <a class="btn btn--heavy" href="{{ route('products.edit', ['product' => $product]) }}">{{ __('products.edit') }}</a>
                </div>
                <!-- Reviews block -->
                <div class="edit-reviews-wr">
                    <p class="edit-attr__head">Reviews</p>
                    <hr class="form-hr">

                    <!-- Post -->
                    @if($review)
                   @include('reviews.web.review')<!-- /. end post -->

                    <div class="t-a-center">
                        <a class="reviews-more__btn" href="{{route('reviews.list',['type' => 'product', 'id' => $product->id])}}">See all reviews</a>
                    </div>
                    @endif
                </div><!-- /. end reviews block -->
            </div>
        </div><!-- /. main shop wrapper -->
    </div><!-- /. end main -->
@endsection