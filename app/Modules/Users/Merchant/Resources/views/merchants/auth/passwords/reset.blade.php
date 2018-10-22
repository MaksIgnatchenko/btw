@extends('layouts.merchants.app')

@section('title', 'Reset password')

@section('content')
    <!-- Main -->
    <div class="main forgot-pass">
        <div class="forgot-wrapper">
            <h1 class="page-title">Forgot password</h1>

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
                    {!! Form::text('email', null, ['placeholder' => 'Enter your email']) !!}
                </p>
            </div>
            <div class="form-content">
                <p>
                    {!! Form::password('password', ['placeholder' => 'Enter a new password']) !!}
                </p>
            </div>
            <div class="form-content form-content--min-margin">
                <p>
                    {!! Form::password('password_confirmation', ['placeholder' => 'Confirm password']) !!}

                </p>
            </div>
            <div class="form-content">
                <p>
                    <button type="submit">Save</button>
                </p>
            </div>

            {!! Form::close() !!}

        </div>
    </div><!-- /. end header -->
@endsection