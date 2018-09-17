@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>Terms & Conditions</h1>
        {{Breadcrumbs::render('content')}}
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        @if ($errors->has('value'))
            <div class="text-red">{{ $errors->first('value') }}</div>
        @endif

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">


                @foreach ($contents as $content)
                    <div class="col-md-6">
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


                @endforeach

            </div>
        </div>
    </div>
@endsection

