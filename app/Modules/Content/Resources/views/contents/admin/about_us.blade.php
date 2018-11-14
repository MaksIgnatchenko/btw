@extends('layouts.app')
@section('title', 'About Us')

@section('content')

    <div class="breadcrumb-container pull-right">
        {{ Breadcrumbs::render('about-us') }}
    </div>

    <div class="clearfix"></div>

    @include('flash::message')

    @if ($errors->has('value'))
        <div class="text-red">{{ $errors->first('value') }}</div>
    @endif

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">


                <div class="col-md-12">
                    {!! Form::model($content, ['route' => ['content.update', $content->key], 'method' => 'put']) !!}

                    <h3>
                        {!! Form::label($content->key, $content->title. ':') !!}
                    </h3>

                    {{ Form::textarea('value', $content->value, [
                    'size' => '30x20',
                    'value' => $content->value,
                    'class' => 'form-control',
                    'style' => 'resize:none',
                    ]) }}
                    <br>
                    <div class="pull-right">
                        {!! Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                    </div>

                    {!! Form::close() !!}


                </div>


        </div>
    </div>
@endsection