@extends('layouts.merchants.app')

@section('title', __('merchants.page_titles.contact_info'))

@section('body-class', 'body-shop')

@section('footer-class', 'footer-shop')

@section('header')
    @include('layouts.merchants.header', ['header_class' => 'header-black'])
@endsection

@section('content')
    <!-- Main -->
    <div class="main-shop">
        <div class="content-page-wrapper container">
            <h1 class="content-page-title">{{ $content->title }}</h1>
            <div class="content-wrapper">
                {!! $content->value !!}
            </div>
        </div>
    </div><!-- /. end main -->
@endsection
