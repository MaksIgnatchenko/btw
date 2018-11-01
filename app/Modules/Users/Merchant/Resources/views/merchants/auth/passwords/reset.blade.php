@extends('layouts.merchants.app')

@section('title', __('merchants.page_titles.password_reset'))

@section('footer-class', 'footer')

@section('header')
    @include('merchants.web.header')
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