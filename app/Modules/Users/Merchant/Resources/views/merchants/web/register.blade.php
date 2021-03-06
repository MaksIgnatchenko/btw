@extends('layouts.merchants.app')

@section('title', __('merchants.page_titles.create_store'))

@section('footer-class', 'footer')

@section('header')
    @include('layouts.merchants.header')
@stop

@section('content')
    <!-- Main -->
    <div class="main store-page">
        <div class="container">
            <h1 class="page-title">{{__('registration.sign_in.title')}}</h1>

            {!! Form::open([
            'route' => 'merchant.registration.set-account-info',
            'method' => 'post',
            'class' => 'form-min',
            'name' => 'create-store-form',
            ]) !!}

            <div class="form-content position-relative">
                <p>
                    {!! Form::text('store', null, ['placeholder' => __('registration.sign_in.store_name')]) !!}
                </p>
                @if ($errors->has('store'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $errors->first('store') }}</strong></div>
                @endif
            </div>
            <div class="form-content position-relative">
                <p>
                    {!! Form::email('email', null, ['placeholder' => __('merchants.email')]) !!}
                </p>
                @if ($errors->has('email'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $errors->first('email') }}</strong></div>
                @endif
            </div>
            <div class="form-content position-relative">
                <p>
                    {!! Form::password('password', ['placeholder' => __('merchants.password')]) !!}
                </p>
                @if ($errors->has('password'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $errors->first('password') }}</strong></div>
                @endif
            </div>
            <div class="form-multiple">
                <div class="form-multiple-cont position-relative">
                    <p>
                        <input type="text" name="captcha" placeholder="{{__('registration.sign_in.captcha_enter')}}">
                    </p>
                    @if ($errors->has('captcha'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $errors->first('captcha') }}</strong></div>
                    @endif
                </div>
                <div class="from-multiple-code">
                    <img src="{{$captcha}}">
                </div>
            </div>
            {!! Form::submit(__('registration.create_store'), ['class' => 'form-content']) !!}

            {!! Form::close() !!}

            <div class="reg-store-bottom">
                <span>{{__('registration.already_have_account_question')}}</span>
                <a href="{{route('index')}}">{{__('merchants.login_here')}}</a>
            </div>
        </div>
    </div><!-- /. end header -->
@endsection