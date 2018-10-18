@extends('layouts.merchants.app')

@section('content')
    <!-- Main -->
    <div class="main tell-page">
        <div class="container">
            <h1 class="page-title">Tell us about your store</h1>
            <form class="tell-form" action="/" method="post" name="tell-form">
                <h6 class="tell-form__title">Where is your inventory/warehouse located?</h6>
                <div class="tell-form-wrapper">
                    <div class="tell-form-country custom-select">
                        <select name="tell-location" id="tell-location">
                            <option value="" disabled selected>Country</option>
                            <option value="Australia">Australia</option>
                            <option value="Austria">Austria</option>
                            <option value="Belgium">Belgium</option>
                            <option value="Canada">Canada</option>
                            <option value="Croatia">Croatia</option>
                            <option value="Denmark">Denmark</option>
                            <option value="Estonia">Estonia</option>
                            <option value="France">France</option>
                            <option value="Spain">Spain</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="Vatican City">Vatican City</option>
                        </select>
                    </div>
                    <div class="tell-form-city">
                        <p>
                            <input type="text" name="tell-city" placeholder="City">
                        </p>
                    </div>
                </div>
                <h6 class="tell-form__title">Product Categories</h6>
                <div class="tell-form-wr-float">
                    <div class="tell-form-category">
                        <p class="tell-form-category__display" id="category-title">Categories</p>
                        <ul class="tell-form-category__list tell-form-category__list--close" id="tell-categories">
                            <li class="tell-form-category__item" id="apple">Apple</li>
                            <li class="tell-form-category__item" id="huawei">Huawei</li>
                            <li class="tell-form-category__item" id="meizu">Meizu</li>
                            <li class="tell-form-category__item" id="samsung">Samsung</li>
                            <li class="tell-form-category__item" id="xiaomi">Xiaomi</li>
                        </ul>
                    </div>
                    <div class="tell-form-labels">
                        <ul class="tell-form-list"></ul>
                    </div>
                </div>
                <h6 class="tell-form__title">Company info</h6>
                <div class="tell-form-area">
                    <textarea name="tell-message" rows="8" placeholder="Write your info"></textarea>
                </div>
                <div class="tell-form-btns">
                    <button class="tell-form-btn tell-form-btn--uncolor">Back</button>
                    <button class="tell-form-btn tell-form-btn--color" type="submit">Enter my Store</button>
                </div>
                <p class="tell-form-attention">By clicking "Enter my store", you agree to <a href="#">Terms of Service</a></p>
            </form>
        </div>
    </div><!-- /. end header -->
@endsection