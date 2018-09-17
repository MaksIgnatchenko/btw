@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>Banner management</h1>
        {{Breadcrumbs::render('advert-create')}}

    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Banner details</h3>
                    </div>
                    <div class="box-body">
                    {!! Form::open(['route' => 'adverts.store', 'files'=>'true']) !!}

                    <!-- Name Field -->
                        <div class="form-group">
                            {!! Form::label('name', 'Name:') !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>

                        <!-- Link Field -->
                        <div class="form-group">
                            {!! Form::label('link', 'Link:') !!}
                            {!! Form::text('link', null, ['class' => 'form-control']) !!}
                        </div>

                        <!-- Link Field -->
                        <div class="form-group">
                            {!! Form::label('image', 'Image:') !!}
                            {!! Form::file('image', ['class' => 'form-control']) !!}
                        </div>

                        <!-- Status Field -->
                        <div class="form-group">
                            {!! Form::label('', 'Active:') !!}
                            <label class="radio-inline">
                                {{ Form::radio('status', AdvertStatusEnum::ACTIVE, null, ['class' => 'field']) }}
                                Yes
                            </label>
                            <label class="radio-inline">

                                {{ Form::radio('status', AdvertStatusEnum::NOT_ACTIVE, null, ['class' => 'field']) }}
                                No
                            </label>

                        </div>

                        <!-- Submit Field -->
                        <div class="text-right">
                            <div class="form-group">
                                {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
