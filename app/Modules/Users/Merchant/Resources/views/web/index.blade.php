@extends('layouts.merchants.app')

@section('content')
    <!-- Main -->
    <div class="main login-page">
        <div class="container">
            <div class="login-page__wrapper">
                <h1 class="page-title page-title--short">Join to unlock the full experience</h1>
                <form class="form-min" action="/" method="post" name="login-form">
                    <div class="form-content form-content--min-margin">
                        <p class="login-form__inp-wr">
                            <span class="icon icon-user"></span>
                            <input type="text" name="login-name" placeholder="Email">
                        </p>
                    </div>
                    <div class="form-content form-content--min-margin">
                        <p class="login-form__inp-wr">
                            <span class="icon icon-password"></span>
                            <input type="password" name="login-pass" placeholder="Password">
                        </p>
                    </div>
                    <div class="reg-store-bottom">
                        <a href="#">Register now</a>
                        <a href="#">Forgot password</a>
                    </div>
                    <div class="form-content form-content--min-margin">
                        <p>
                            <button type="submit">Sign in</button>
                        </p>
                    </div>
                    <p class="login-form__info">By signing in, you agree to the <a href="#">Terms and Conditions</a> and
                        <a href="#">Privacy Policy</a></p>
                </form>
            </div>
        </div>
    </div><!-- /. end header -->
@endsection