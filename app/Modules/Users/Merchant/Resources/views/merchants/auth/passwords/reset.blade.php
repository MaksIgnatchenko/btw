@extends('layouts.merchants.app')

@section('title', __('merchants.page_titles.password_reset'))

@section('footer-class', 'footer')

@section('header')
    <header class="@isset($header_class) {{$header_class}} @endisset header">
        <div class="container">
            <div class="header__cont">
                <div class="header__logo">
                    <a href="{{route('index')}}">Logotype BTW</a>
                </div>
                <div class="header__info">
                    <div class="header__lang">English<span>EN</span></div>

                    @guest
                        <nav class="navigation">
                            @if (Route::currentRouteName() !== 'index')
                                <a href="{{ url('products/') }}">{{__('merchants.home')}}</a>
                            @endif

                            <a target="_blank"
                               href="{{ route('merchant.content', ['content' => 'terms_and_conditions']) }}">
                                {{__('merchants.terms_and_conditions')}}
                            </a>
                        </nav>
                    @endguest

                </div>
            </div>
        </div>
    </header><!-- /. end header -->
@stop

@section('content')
    <!-- Main -->
    <div class="main forgot-pass">
        <div class="forgot-wrapper">
            <h1 class="page-title">{{__('merchants.forgot_password')}}</h1>

            {!! Form::open([
    'route' => 'password.request',
    'method' => 'post',
    'class' => 'form-forgot',
    'name' => 'password-form',
    ]) !!}

            @if($errors->count())
                <div class="login-error-message">{{$errors->first()}}</div>
            @endif

            @if(Session::has('status'))
                <div class="login-error-message">{{Session::get('status')}}</div>
            @endif

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-content">
                <p>
                    {!! Form::text('email', null, ['placeholder' => __('merchants.password_restore.email')]) !!}
                </p>
            </div>
            <div class="form-content">
                <p>
                    {!! Form::password('password', ['placeholder' => __('merchants.password_restore.enter_new_pasword')]) !!}
                </p>
            </div>
            <div class="form-content form-content--min-margin">
                <p>
                    {!! Form::password('password_confirmation', ['placeholder' => __('merchants.password_restore.confirm_password')]) !!}

                </p>
            </div>
            <div class="form-content">
                <p>
                    <button type="submit">{{__('merchants.save')}}</button>
                </p>
            </div>

            {!! Form::close() !!}

        </div>
    </div><!-- /. end header -->
@endsection