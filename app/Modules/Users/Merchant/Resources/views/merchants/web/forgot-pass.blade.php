@extends('layouts.merchants.app')

@section('content')
    <!-- Main -->
    <div class="main forgot-pass">
        <div class="forgot-wrapper">
            <h1 class="page-title">Forgot password</h1>
            <form class="form-forgot" action="/" method="post" name="password-form">
                <div class="form-content">
                    <p>
                        <input type="text" name="new-password" placeholder="Enter a new password">
                    </p>
                </div>
                <div class="form-content form-content--min-margin">
                    <p>
                        <input type="text" name="confirm-password" placeholder="Confirm password">
                    </p>
                </div>
                <div class="form-content">
                    <p>
                        <button type="submit">Save</button>
                    </p>
                </div>
            </form>
        </div>
    </div><!-- /. end header -->
@endsection