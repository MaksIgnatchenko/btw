@extends('layouts.merchants.app')

@section('content')
    <!-- Main -->
    <div class="main store-page">
        <div class="container">
            <h1 class="page-title">Create your free store today</h1>
            <form class="form-min" action="/" method="post" name="create-store-form">
                <div class="form-content">
                    <p>
                        <input type="text" name="store-name" placeholder="Store name">
                    </p>
                </div>
                <div class="form-content">
                    <p>
                        <input type="email" name="store-email" placeholder="Email">
                    </p>
                </div>
                <div class="form-content">
                    <p>
                        <input type="password" name="store-pass" placeholder="Password">
                    </p>
                </div>
                <div class="form-multiple">
                    <div class="form-multiple-cont">
                        <p>
                            <input type="text" name="store-code" placeholder="Enter the code in the picture">
                        </p>
                    </div>
                    <div class="from-multiple-code">
                        <span>46q12R</span>
                    </div>
                </div>
                <div class="form-content">
                    <button type="submit">Create Store</button>
                </div>
            </form>
            <div class="reg-store-bottom">
                <span>Already have an account?</span>
                <a href="#">Login Here</a>
            </div>
        </div>
    </div><!-- /. end header -->
@endsection