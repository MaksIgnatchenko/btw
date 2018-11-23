@extends('layouts.merchants.app')

@section('title', __('store.404_page.title'))

@section('body-class', 'body-shop')

@section('css')
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700" rel="stylesheet">
@endsection

@section('content')
    <!-- Main -->
    <div class="main-shop">

        <!-- Main wrapper -->
        <div class="main-shop-wrapper error-page">
            <div class="error-page__wrapper container">
                <h1 class="error-page__title">{{ __('store.404_page.error') }}</h1>
                <div class="error-page__fig">
                    <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 758 299" style="enable-background:new 0 0 758 299;" xml:space="preserve">
                    <style type="text/css">
                        .st0{fill:#F8E71C;}
                        .st1{font-family:'Montserrat';}
                        .st2{font-size:404.1224px;}
                        .st3{font-size:406.8106px;}
                    </style>
                        <g id="WEB-_x2F_-UI-Design-_x2F_-Merchants">
                            <g id="_x34_04" transform="translate(-596.000000, -382.000000)">
                                <path id="Ghost" class="st0" d="M1033.3,519.3c-14,0-25.4-11.3-25.4-25.3c0-14,11.4-25.3,25.4-25.3c14,0,25.4,11.4,25.4,25.3
                                C1058.7,508,1047.3,519.3,1033.3,519.3 M889.3,494c0-14,11.4-25.3,25.4-25.3c14,0,25.4,11.4,25.4,25.3c0,14-11.4,25.3-25.4,25.3
                                C900.7,519.3,889.3,508,889.3,494 M974,382c-127,0-127,118.3-127,118.3v180.5l31.8-42.2l31.7,42.2l31.7-42.2l31.7,42.2l31.7-42.2
                                l31.7,42.2l31.7-42.2l31.9,42.2V500.3C1101,500.3,1101,382,974,382"/>
                            </g>
                        </g>
                        <text transform="matrix(0.8413 0 0 1 0 293.5)" class="st0 st1 st2">4</text>
                        <text transform="matrix(0.8358 0 0 1 515 292.7852)" class="st0 st1 st3">4</text>
                </svg>
                </div>
                <p class="error-page__txt">
                    {{ __('store.404_page.description_first') }}<br />
                    {{ __('store.404_page.description_second') }}
                    <a href="{{ route('products.index') }}">{{ __('store.404_page.url_text') }}</a>
                </p>
            </div>
        </div><!-- /. main wrapper -->
    </div><!-- /. end main -->
@endsection

@section('footer', '');