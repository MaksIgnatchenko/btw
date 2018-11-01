@extends('layouts.merchants.app')

@section('title', __('store.store'))

@section('body-class', 'body-shop')

@section('footer-class', 'footer-shop')

@section('header')
    @include('products.web.header')
@endsection

@section('content')
    <!-- Main -->
    <div class="main-shop">

        @include('products.web.navigation')

        <!-- Main shop wrapper -->
        <div class="main-shop-wrapper">
            <div class="container">
                <!-- Add new -->
                <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data" name="add-new-product">
                    <p class="form-title">Add a new product</p>
                    <hr class="form-hr">

                    <!-- form container -->
                    <div class="form-container">
                        <div class="form-line__wrapper">
                            <div class="form-item__wrapper form-item__wrapper--text">
                                <p class="form-item__title">Product name</p>
                            </div>
                            <div class="form-item__wrapper form-item__wrapper--field">
                                <input class="form-item__inp" type="text" name="add-new-name" maxlength="170" placeholder="Please enter product name">
                            </div>
                        </div>

                        <div class="form-line__wrapper">
                            <div class="form-item__wrapper form-item__wrapper--text">
                                <p class="form-item__title">Select a category</p>
                            </div>
                            <div class="form-item__wrapper form-item__wrapper--field">
                                <div class="custom-select">
                                    <select name="add-new-categories" id="tell-location">
                                        <option value="" disabled selected>Categories</option>
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
                                        <option value="United Kingdom">United State Of America</option>
                                        <option value="Vatican City">Vatican City</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div><!-- /. end form container -->

                    <hr class="form-hr">

                    <!-- form container -->
                    <div class="form-container">
                        <div class="form-line__wrapper">
                            <div class="form-item__wrapper form-item__wrapper--text">
                                <p class="form-item__title">Description</p>
                            </div>
                            <div class="form-item__wrapper form-item__wrapper--field">
                                <textarea class="form-item__area" name="add-new-description" rows="10" maxlength="1000" placeholder="Product description ..."></textarea>
                            </div>
                        </div>
                    </div><!-- /. end form container -->
                    <p class="form-title">Product's attributes</p>

                    <hr class="form-hr">

                    <div class="form-container">
                        <div class="form-line__wrapper form-line__wrapper--min-margin">
                            <div class="form-item__wrapper form-item__wrapper--text">
                                <p class="form-item__title">Quantity</p>
                            </div>
                            <div class="form-item__wrapper form-item__wrapper--field">
                                <input class="form-item__inp" type="text" name="add-new-quantity" maxlength="7" placeholder="Enter the value">
                            </div>
                        </div>

                        <div class="form-line__wrapper form-line__wrapper--min-margin">
                            <div class="form-item__wrapper form-item__wrapper--text">
                                <p class="form-item__title">Color</p>
                            </div>
                            <div class="form-item__wrapper form-item__wrapper--field">
                                <input class="form-item__inp" type="text" name="add-new-color" maxlength="100" placeholder="Enter the value">
                            </div>
                        </div>

                        <div class="form-line__wrapper form-line__wrapper--min-margin">
                            <div class="form-item__wrapper form-item__wrapper--text">
                                <p class="form-item__title">Size</p>
                            </div>
                            <div class="form-item__wrapper form-item__wrapper--field">
                                <input class="form-item__inp" type="text" name="add-new-size" maxlength="20" placeholder="Enter the value">
                            </div>
                        </div>

                        <div class="form-line__wrapper form-line__wrapper--min-margin">
                            <div class="form-item__wrapper form-item__wrapper--text">
                                <p class="form-item__title">Material</p>
                            </div>
                            <div class="form-item__wrapper form-item__wrapper--field">
                                <input class="form-item__inp" type="text" name="add-new-material" maxlength="100" placeholder="Enter the value">
                            </div>
                        </div>
                    </div><!-- /. end form container -->

                    <hr class="form-hr">

                    <div class="form-container">
                        <div class="form-line__wrapper form-line__wrapper--min-margin">
                            <div class="form-item__wrapper form-item__wrapper--text">
                                <p class="form-item__title">Product photo</p>
                                <p class="form-item__descr">Maximum number of photos: 5 pcs.</p>
                            </div>
                            <div class="form-item__wrapper form-item__wrapper--files">
                                <ul class="form-item__list">
                                    <li class="form-item__block">
                                        <label class="form-item__label">
                                            <span class="form-item__label-decor"></span>
                                            <input class="form-item__inp-file" type="file" name="add-image-1" accept=".jpg, .jpeg, .png">
                                        </label>
                                    </li>

                                    <li class="form-item__block">
                                        <label class="form-item__label">
                                            <span class="form-item__label-decor"></span>
                                            <input class="form-item__inp-file" type="file" name="add-image-2" accept=".jpg, .jpeg, .png">
                                        </label>
                                    </li>

                                    <li class="form-item__block">
                                        <label class="form-item__label">
                                            <span class="form-item__label-decor"></span>
                                            <input class="form-item__inp-file" type="file" name="add-image-3" accept=".jpg, .jpeg, .png">
                                        </label>
                                    </li>

                                    <li class="form-item__block">
                                        <label class="form-item__label">
                                            <span class="form-item__label-decor"></span>
                                            <input class="form-item__inp-file" type="file" name="add-image-4" accept=".jpg, .jpeg, .png">
                                        </label>
                                    </li>

                                    <li class="form-item__block">
                                        <label class="form-item__label">
                                            <span class="form-item__label-decor"></span>
                                            <input class="form-item__inp-file" type="file" name="add-image-5" accept=".jpg, .jpeg, .png">
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- /. end form container -->

                    <hr class="form-hr">

                    <div class="form-container">
                        <div class="form-line__wrapper form-line__wrapper--min-margin">
                            <div class="form-item__wrapper form-item__wrapper--text">
                                <p class="form-item__title">Price</p>
                            </div>
                            <div class="form-item__wrapper form-item__wrapper--field">
                                <span class="form-item__currency">$</span>
                                <input class="form-item__inp form-item__inp--price" type="number" name="add-new-price" min="1" max="999999999" maxlength="9">
                                <p class="form-item__inp-descr">Attention! 15% of the item’s price is transferred to the website.</p>
                            </div>
                        </div>
                    </div><!-- /. end form container -->

                    <div class="form-hr-wrapper">
                        <span class="form-hr__decor"></span>
                        <hr class="form-hr">
                    </div>

                    <div class="form-wrapper__btn form-wrapper__btn--ta-r">
                        <button type="submit">Create</button>
                    </div>

                </form><!-- /. end add new -->
            </div><!-- /. end container -->
        </div><!-- /. main shop wrapper -->
    </div><!-- /. end main -->
@endsection