@extends('layouts.merchants.app')

@section('title', 'Password reset request')

@section('content')
    <!-- Main -->
    <div class="main forgot-pass">
        <div class="forgot-wrapper">
            <h1 class="page-title">Forgot password</h1>

            {!! Form::open([
        'route' => 'merchant.password.email',
        'method' => 'post',
        'class' => 'form-forgot',
        'name' => 'forgot-password-form',
        ]) !!}

            @if($errors->count())
                <div class="login-error-message">{{$errors->first()}}</div>
            @endif

            @if(Session::has('status'))
                <div class="login-error-message">{{Session::get('status')}}</div>
            @endif

            <div class="form-content form-content--min-margin">
                <p>
                    {!! Form::text('email', null, ['placeholder' => 'Enter your email']) !!}
                </p>
            </div>
            <p class="forgot-pass__info">Please enter your e-mail to recover password</p>
            <div class="form-content">
                <p>
                    {!! Form::submit('Reset Password') !!}
                </p>
            </div>

            {!! Form::close() !!}

        </div>
    </div><!-- /. end header -->
@endsection