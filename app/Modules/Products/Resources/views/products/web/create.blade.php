@extends('layouts.merchants.app')

@section('title', __('store.store'))

@section('body-class', 'body-shop')

@section('footer-class', 'footer-shop')

@section('header')
    @include('products.web.header')
@endsection

@section('script')
    <script src="{{asset('js/marchants/products/category-tree.js')}}"></script>
@endsection

@section('content')
    <!-- Main -->
    <div class="main-shop">

        @include('products.web.navigation')

        <!-- Main shop wrapper -->
        <div class="main-shop-wrapper">
            <div class="container">
                <!-- Add new -->
                {!! Form::model(null, ['route' => ['products.store'], 'method' => 'POST', 'files' => true, 'name' => 'add-new-product']) !!}
                    <p class="form-title">{{__('products.create_product_section_title')}}</p>
                    <hr class="form-hr">

                    <!-- form container -->
                    <div class="form-container">
                        <div class="form-line__wrapper">
                            <div class="form-item__wrapper form-item__wrapper--text">
                                <p class="form-item__title">{{__('products.create_name')}}</p>
                            </div>
                            <div class="form-item__wrapper form-item__wrapper--field">
                                <input class="form-item__inp" type="text" name="name" maxlength="170" placeholder="{{__('products.create_name_placeholder')}}">
                            </div>
                        </div>

                        <div class="form-line__wrapper">
                            <div class="form-item__wrapper form-item__wrapper--text">
                                <p class="form-item__title">{{__('products.create_category')}}</p>
                            </div>
                            <div class="form-item__wrapper form-item__wrapper--field">
                                <div class="custom-select">
                                    {{ Form::select('category_id', ['Category'] + $categories, 'Category', ['name' => 'category_id', 'id' => 'categories', 'onChange' => 'getCategoryAttributes($(this).children(":selected").attr("value"))']) }}
                                </div>
                            </div>
                        </div>
                    </div><!-- /. end form container -->

                    <hr class="form-hr">

                    <!-- form container -->
                    <div class="form-container">
                        <div class="form-line__wrapper">
                            <div class="form-item__wrapper form-item__wrapper--text">
                                <p class="form-item__title">{{__('products.create_description')}}</p>
                            </div>
                            <div class="form-item__wrapper form-item__wrapper--field">
                                <textarea class="form-item__area" name="description" rows="10" maxlength="1000" placeholder="{{__('products.create_description_placeholder')}}"></textarea>
                            </div>
                        </div>
                    </div><!-- /. end form container -->
                    <p class="form-title">{{__('products.create_attribute_section_title')}}</p>

                    <hr class="form-hr">

                    <div class="form-container">
                        <div class="form-line__wrapper form-line__wrapper--min-margin">
                            <div class="form-item__wrapper form-item__wrapper--text">
                                <p class="form-item__title">{{__('products.create_quantity')}}</p>
                            </div>
                            <div class="form-item__wrapper form-item__wrapper--field">
                                <input class="form-item__inp" type="text" name="quantity" maxlength="7" placeholder="{{__('products.create_attribute_section_placeholder')}}">
                            </div>
                        </div>
                        <div class="attributes-container">

                        </div>
                    </div><!-- /. end form container -->

                    <hr class="form-hr">

                    <div class="form-container">
                        <div class="form-line__wrapper form-line__wrapper--min-margin">
                            <div class="form-item__wrapper form-item__wrapper--text">
                                <p class="form-item__title">{{__('products.create_photo_section_title')}}</p>
                                <p class="form-item__descr">{{__('products.create_photo_section_description')}}</p>
                            </div>
                            <div class="form-item__wrapper form-item__wrapper--files">
                                <ul class="form-item__list">
                                    <li class="form-item__block">
                                        <label class="form-item__label">
                                            <span class="form-item__label-decor"></span>
                                            <input class="form-item__inp-file" type="file" name="main_image" accept=".jpg, .jpeg, .png">
                                        </label>
                                    </li>

                                    <li class="form-item__block">
                                        <label class="form-item__label">
                                            <span class="form-item__label-decor"></span>
                                            <input class="form-item__inp-file" type="file" name="product_gallery[]" accept=".jpg, .jpeg, .png">
                                        </label>
                                    </li>

                                    <li class="form-item__block">
                                        <label class="form-item__label">
                                            <span class="form-item__label-decor"></span>
                                            <input class="form-item__inp-file" type="file" name="product_gallery[]" accept=".jpg, .jpeg, .png">
                                        </label>
                                    </li>

                                    <li class="form-item__block">
                                        <label class="form-item__label">
                                            <span class="form-item__label-decor"></span>
                                            <input class="form-item__inp-file" type="file" name="product_gallery[]" accept=".jpg, .jpeg, .png">
                                        </label>
                                    </li>

                                    <li class="form-item__block">
                                        <label class="form-item__label">
                                            <span class="form-item__label-decor"></span>
                                            <input class="form-item__inp-file" type="file" name="product_gallery[]" accept=".jpg, .jpeg, .png">
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
                                <p class="form-item__title">{{__('products.create_price')}}</p>
                            </div>
                            <div class="form-item__wrapper form-item__wrapper--field">
                                <span class="form-item__currency">$</span>
                                <input class="form-item__inp form-item__inp--price" type="number" name="price" min="1" max="9999999" step=".01" maxlength="9">
                                <p class="form-item__inp-descr">{{__('products.create_price_description')}}</p>
                            </div>
                        </div>
                    </div><!-- /. end form container -->

                    <div class="form-hr-wrapper">
                        <span class="form-hr__decor"></span>
                        <hr class="form-hr">
                    </div>

                    <div class="form-wrapper__btn form-wrapper__btn--ta-r">
                        {!! Form::submit(__('products.create_submit')) !!}
                    </div>

            {!! Form::close() !!}<!-- /. end add new -->
            </div><!-- /. end container -->
        </div><!-- /. main shop wrapper -->
    </div><!-- /. end main -->
@endsection