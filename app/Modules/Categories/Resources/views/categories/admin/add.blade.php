@extends('layouts.app')
@section('title', 'Add root category')
@section('content')

    <div class="breadcrumb-container pull-right">
        {{ Breadcrumbs::render('add-category') }}
    </div>
    
    <section class="content">
        <div class="clearfix"></div>

        @include('flash::message')
        {!! Form::open(['route' => ['categories.save-category'], 'method' => 'post', 'files' => true]) !!}
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
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            @if ($errors->has('name'))
                                <div class="text-red">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <div class="form-group">

                            {{ Form::label('icon', 'Icon') }}
                            {!! Form::file('icon', ['accept' => 'image/*']) !!}
                            @if ($errors->has('icon'))
                                <div class="text-red">{{ $errors->first('icon') }}</div>
                            @endif
                        </div>

                        <!-- Submit Field -->
                        <div class="form-group text-right">
                            {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    </section>
@endsection
