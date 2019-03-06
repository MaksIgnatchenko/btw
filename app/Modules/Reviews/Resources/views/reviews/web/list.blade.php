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
    @if('merchant' === $type)
        @include('layouts.merchants.navigation', ['active' => 'reviews'])
    @else
        @include('layouts.merchants.navigation')
    @endif
    <!-- Main shop wrapper -->
        <div class="main-shop-wrapper">
            <div class="container">
                @if('merchant' === $type && isset($merchant))
                <h6 class="p-title">My rating:</h6>
                <div class="rating-wr">
                    <div class="rating__grade">
                       {{$merchant->rating}}
                    </div>
                    @include('reviews.web.rating', ['owner' => $merchant])
                </div>
                @endif
                @foreach($reviews as $review)
                    @include('reviews.web.review')
                @endforeach
                {{ $reviews->links() }}
            </div>
        </div>
@endsection