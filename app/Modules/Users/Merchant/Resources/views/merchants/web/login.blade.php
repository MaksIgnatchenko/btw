@extends('layouts.merchants.app')

@section('title', 'BTW')

@section('content')
    <!-- Main -->
    <div class="main login-page">
        <div class="container">
            <div class="login-page__wrapper">
                <h1 class="page-title page-title--short">Join to unlock the full experience</h1>

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
                        'placeholder' => 'Email',
                        'class' => $errors->has('email') ? 'registration-field-valid-fail' : '',
                        ]
                        ) !!}
                    </p>
                </div>
                <div class="form-content form-content--min-margin">
                    <p class="login-form__inp-wr">
                        <span class="icon icon-password"></span>
                        {!! Form::password('password', [
                        'placeholder' => 'Password',
                        'class' => $errors->has('password') ? 'registration-field-valid-fail' : '',
                        ]) !!}
                    </p>
                </div>
                <div class="reg-store-bottom">
                    <a href="{{route('merchant.registration.sign-up')}}">Register now</a>
                    <a href="{{route('merchant.password.request')}}">Forgot password</a>
                </div>
                <div class="form-content form-content--min-margin">
                    <p>
                        <button type="submit">Sign in</button>
                    </p>
                </div>
                <p class="login-form__info">By signing in, you agree to the <a href="#">Terms and Conditions</a> and
                    <a href="#">Privacy Policy</a></p>
                {!! Form::close() !!}
            </div>
        </div>
    </div><!-- /. end header -->
@endsection