@extends('layouts.merchants.app')

@section('content')
    <!-- Main -->
    <div class="main forgot-pass">
        <div class="forgot-wrapper">
            <h1 class="page-title">Forgot password</h1>
            <form class="form-forgot" action="/" method="post" name="forgot-password-form">
                <div class="form-content form-content--min-margin">
                    <p>
                        <input type="text" name="forgot-password-email" placeholder="Enter your email">
                    </p>
                </div>
                <p class="forgot-pass__info">Please enter your e-mail to recover password</p>
                <div class="form-content">
                    <p>
                        <button type="submit">Reset Password</button>
                    </p>
                </div>
            </form>
        </div>
    </div><!-- /. end header -->
@endsection