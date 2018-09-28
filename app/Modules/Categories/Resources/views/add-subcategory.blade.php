@extends('layouts.app')

@section('content')


    <section class="content-header">
        <h1>Add subcategory to {{$category->name}}</h1>
    </section>
    <section class="content">
        <div class="clearfix"></div>

        @include('flash::message')
        {!! Form::open(['route' => ['categories.save-subcategory'], 'method' => 'post']) !!}

        <div class="col-md-4">
            <div class="row">

                <div class="box">
                    <div class="box-body">

                        {!! Form::hidden('parent_category_id', $category->id) !!}
                        @if ($errors->has('parent_category_id'))
                            <div class="text-red">{{ $errors->first('parent_category_id') }}</div>
                        @endif

                        <div class="form-group">
                            {{ Form::label('name', 'Name: ') }}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            @if ($errors->has('name'))
                                <div class="text-red">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('is_final', 1, true) !!}
                                is final
                            </label>

                            @if ($errors->has('is_final'))
                                <div class="text-red">{{ $errors->first('is_final') }}</div>
                            @endif
                        </div>

                        <div class="form-group text-right">
                            {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div id="categories-additional-fields">
            <div class="col-md-4">
                @include('attributes')
            </div>
            <div class="col-md-4">
                @include('parameters')
            </div>
        </div>
        {!! Form::close() !!}

    </section>
@endsection

@include('categories-libs')

