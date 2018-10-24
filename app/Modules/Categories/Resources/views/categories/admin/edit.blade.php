@extends('layouts.app')
@section('title', 'Edit category ' . $category->name)

@section('content')

    <section class="content">
        <div class="clearfix"></div>

        @include('flash::message')
        {!! Form::open(['route' => ['categories.update', $category], 'method' => 'post', 'files' => true]) !!}
        <div class="row">
            <div class="col-md-4">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Category details</h3>
                    </div>
                    <div class="box-body">

                        <!-- Status Field -->
                        <div class="form-group">

                            {{ Form::label('name', 'Name: ') }}
                            {!! Form::text('name', $category->name, ['class' => 'form-control']) !!}
                            @if ($errors->has('name'))
                                <div class="text-red">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        @if(!$category->parent_category_id)
                            <img class="img-fluid" src="{{$category->icon}}">
                            <div class="form-group">

                                {{ Form::label('icon', 'Icon') }}
                                {!! Form::file('icon', ['accept' => 'image/*']) !!}
                                @if ($errors->has('icon'))
                                    <div class="text-red">{{ $errors->first('icon') }}</div>
                                @endif
                            </div>
                    @endif

                    <!-- Submit Field -->
                        <div class="form-group text-right">
                            {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                </div>
            </div>
            @if($category->is_final)
                <div class="col-md-4">
                    @include('attributes')
                </div>
            @endif
        </div>
        {!! Form::close() !!}

    </section>
@endsection

@if($category->is_final)
    @include('categories-libs')
@endif