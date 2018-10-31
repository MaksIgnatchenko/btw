@extends('layouts.merchants.app')

@section('title', 'BTW')

@section('footer-class', 'footer')

@section('header')
    @include('merchants.web.header')
@stop

@section('content')
    <!-- Main -->
    <div class="main login-page">
        <div class="container">
            <div class="login-page__wrapper">
                <h1 class="page-title page-title--short">{{__('merchants.login.join')}}</h1>

                @if($errors->count())
                    <div class="login-error-message">{{$errors->first()}}</div>
                @endif

                {!! Form::open([
            'route' => 'merchant.login',
            'method' => 'post',
            'class' => 'form-min',
            'name' => 'login-form',
            ]) !!}

                <div class="form-content form-content--min-margin">
                    <p class="login-form__inp-wr">
                        <span class="icon icon-user"></span>
                        {!! Form::text('email', null, [
                        'placeholder' => __('merchants.email'),
                        'class' => $errors->has('merchants.email') ? 'registration-field-valid-fail' : '',
                        ]
                        ) !!}
                    </p>
                </div>
                <div class="form-content form-content--min-margin">
                    <p class="login-form__inp-wr">
                        <span class="icon icon-password"></span>
                        {!! Form::password('password', [
                        'placeholder' => __('merchants.password'),
                        'class' => $errors->has('password') ? 'registration-field-valid-fail' : '',
                        ]) !!}
                    </p>
                </div>
                <div class="reg-store-bottom">
                    <a href="{{route('merchant.registration.sign-up')}}">{{__('merchants.register_now')}}</a>
                    <a href="{{route('merchant.password.request')}}">{{__('merchants.forgot_password')}}</a>
                </div>
                <div class="form-content form-content--min-margin">
                    <p>
                        <button type="submit">{{__('merchants.login.sign_in')}}</button>
                    </p>
                </div>
                <p class="login-form__info">
                    {!! __('merchants.agreement', [
                    'tc_link' => '#',
                    'pp_link' => '#',
                    ]) !!}
                </p>
                {!! Form::close() !!}
            </div>
        </div>
    </div><!-- /. end header -->
@endsection