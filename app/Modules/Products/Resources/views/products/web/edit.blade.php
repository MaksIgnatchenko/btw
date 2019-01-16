@extends('layouts.merchants.app')

@section('title', __('store.store'))

@section('body-class', 'body-shop')

@section('footer-class', 'footer-shop')

@section('header')
    @include('layouts.merchants.header', ['header_class' => 'header-black'])
@endsection

@section('script')
    <script src="{{asset('js/merchants/products/category-tree.js')}}"></script>
    <script src="{{asset('js/merchants/products/remove-old-images.js')}}"></script>
    <script src="{{asset('js/Validator.js')}}"></script>
    <script src="{{asset('js/SelectDecorator.js')}}"></script>
    <script src="{{asset('js/merchants/products/selectDecorator.js')}}"></script>
@endsection

@section('content')
    <!-- Main -->
    <div class="main-shop">

    @include('layouts.merchants.navigation', ['active' => 'products'])

    <!-- Main shop wrapper -->
        <div class="main-shop-wrapper">
            <div class="container">
                <!-- Add new -->
                {!! Form::model($product, ['route' => ['products.update', 'product' => $product->id], 'method' => 'PATCH', 'files' => true, 'name' => 'edit-product']) !!}
                <p class="form-title">{{__('products.edit_product_section_title')}}</p>
                <hr class="form-hr">

                <!-- form container -->
                <div class="form-container">
                    <div class="form-line__wrapper">
                        <div class="form-item__wrapper form-item__wrapper--text">
                            <p class="form-item__title">{{__('products.create_name')}}</p>
                        </div>
                        <div class="form-item__wrapper form-item__wrapper--field">
                            {!! Form::text('name', null, [
                            'placeholder' => __('products.create_name_placeholder'),
                            'maxlength' => '170',
                            'class' => 'form-item__inp',
                            'required']
                            ) !!}
                            @if ($errors->has('name'))
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong></div>
                            @endif
                        </div>
                    </div>

                    <div class="form-line__wrapper">
                        <div class="form-item__wrapper form-item__wrapper--text">
                            <p class="form-item__title">{{__('products.create_category')}}</p>
                        </div>
                        <div class="form-item__wrapper form-item__wrapper--field">
                            <div class="custom-select">
                                {{ Form::select('category_id', ['Category'] + $categories, $product->category_id, ['name' => 'category_id', 'id' => 'categories']) }}
                            </div>
                            @if ($errors->has('category_id'))
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $errors->first('category_id') }}</strong></div>
                            @endif
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
                            {!! Form::textarea('description', null, [
                            'placeholder' => __('products.create_description_placeholder'),
                            'rows' => '10',
                            'maxlength' => '1000',
                            'class' => 'form-item__area',
                            'required']
                            ) !!}
                            @if ($errors->has('description'))
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong></div>
                            @endif
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
                            {!! Form::number('quantity', null, [
                            'placeholder' => __('products.create_attribute_section_placeholder'),
                            'maxlength' => '7',
                            'class' => 'form-item__inp',
                            'required']
                            ) !!}
                            @if ($errors->has('quantity'))
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $errors->first('quantity') }}</strong></div>
                            @endif
                        </div>
                    </div>

                    <div class="attributes-container">
                        @foreach($product->attributes as $key => $data)
                            <div class="form-line__wrapper form-line__wrapper--min-margin">
                                <div class="form-item__wrapper form-item__wrapper--text">
                                    <p class="form-item__title">{{$key}}</p>
                                </div>
                                <div class="form-item__wrapper form-item__wrapper--field">
                                    @if($data['type'] === 'text')
                                        @php $fieldType = 'text'; @endphp
                                    @else
                                        @php $fieldType = 'number'; @endphp
                                    @endif
                                    {!! Form::$fieldType("attributes[{$data['type']}][{$key}]", $data['value'], [
                                 'placeholder' => __('products.create_attribute_section_placeholder'),
                                 'class' => 'form-item__inp', 'required']
                                 ) !!}
                                    @if($errors->has("attributes.{$data['type']}.$key"))
                                        <div class="alert alert-danger" role="alert">
                                            <strong>{{ $errors->first("attributes.{$data['type']}.$key") }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
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
                                <li class="form-item__block" style="background-image: url({{$product->main_image}});">
                                    <label class="form-item__label">
                                        <span class="form-item__label-decor"></span>
                                        <input class="form-item__inp-file" type="file" name="main_image"
                                               accept=".jpg, .jpeg, .png">
                                    </label>
                                </li>

                                @php $imgCount = 0; @endphp

                                @foreach ($product->images as $image)
                                    @php $imgCount++; @endphp
                                    <li class="form-item__block photo-additional"
                                        style="background-image: url({{$image->image}});" data-url="{{$image->image}}">
                                        <label class="form-item__label form-item__label--remove">
                                            <span class="form-item__label-decor"></span>
                                            <input class="form-item__inp-file" type="file" name="product_gallery[]"
                                                   accept=".jpg, .jpeg, .png" disabled="disabled">
                                        </label>
                                    </li>
                                @endforeach

                                @for ($i = $imgCount + 1; $i <= 4; $i++)
                                    <li class="form-item__block">
                                        <label class="form-item__label">
                                            <span class="form-item__label-decor"></span>
                                            <input class="form-item__inp-file" type="file" name="product_gallery[]"
                                                   accept=".jpg, .jpeg, .png">
                                        </label>
                                    </li>
                                @endfor
                            </ul>
                            @if ($errors->has('main_image'))
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $errors->first('main_image') }}</strong></div>
                            @endif
                            @if ($errors->has('product_gallery.*'))
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $errors->first('product_gallery.*') }}</strong></div>
                            @endif
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
                            {!! Form::number('price', null, [
                            'min' => '1',
                            'max' => '9999999',
                            'step' => '.01',
                            'maxlength' => '9',
                            'class' => 'form-item__inp form-item__inp--price',
                            'required']
                            ) !!}
                            @if ($errors->has('price'))
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $errors->first('price') }}</strong></div>
                            @endif
                            <p class="form-item__inp-descr">{{__('products.create_price_description')}}</p>
                        </div>
                    </div>

                    <div class="form-line__wrapper form-line__wrapper--min-margin">
                        <div class="form-item__wrapper form-item__wrapper--text">
                            <p class="form-item__title">{{__('products.create_delivery_price')}}</p>
                        </div>
                        <div class="form-item__wrapper form-item__wrapper--field">
                            <span class="form-item__currency">$</span>
                            {!! Form::number('delivery_price', null, ['class' => 'form-item__inp form-item__inp--price', 'min' => 0, 'max' => 9999999, 'step' => '.01', 'maxlength' => 9, 'required']) !!}
                            @if ($errors->has('delivery_price'))
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $errors->first('delivery_price') }}</strong></div>
                            @endif
                            <p class="form-item__inp-descr">{{__('products.create_delivery_price_description_1')}}
                                <a href="https://epacketexpress.com/can-ship-larger-heavier-packages-via-epacket/" target="_blank">here</a>
                            </p>
                            <p class="form-item__inp-descr">{{__('products.create_delivery_price_description_2')}}
                                <a href="https://www.epackettracking.com/epacket-shipping-cost-online-calculation/" target="_blank">ePacket</a>
                            </p>
                        </div>
                    </div>

                </div><!-- /. end form container -->

                <div class="form-hr-wrapper">
                    <span class="form-hr__decor"></span>
                    <hr class="form-hr">
                </div>

                <div class="form-wrapper__btn form-wrapper__btn--ta-r">
                    {!! Form::submit(__('products.update_submit'), ['class' => 'edit-product submit']) !!}
                </div>

            {!! Form::close() !!}<!-- /. end add new -->
            </div><!-- /. end container -->
        </div><!-- /. main shop wrapper -->
    </div><!-- /. end main -->
@endsection