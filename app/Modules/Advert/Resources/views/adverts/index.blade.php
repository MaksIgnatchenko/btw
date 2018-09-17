@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>Ad banners</h1>
        {{Breadcrumbs::render('adverts')}}
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')

        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Custom banners list</h3>
                    </div>
                    <div class="box-body">
                        @include('adverts.table')
                        <h1 class="pull-right">
                            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px"
                               href="{!! route('adverts.create') !!}">Add New</a>
                        </h1>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Banner management</h3>
                    </div>
                    <div class="box-body">
                        {!! Form::model($advertConfig, ['route' => ['advert-config.update', \App\Modules\Advert\Models\AdvertConfig::MODE], 'method' => 'put']) !!}

                        <div class="form-group">
                            {!! Form::label('', 'Banner type:') !!}
                            <label class="radio-inline">
                                {{ Form::radio('value', \App\Modules\Advert\Models\AdvertConfig::ADMOB_MODE, null, ['class' => 'field']) }}
                                Admob
                            </label>
                            <label class="radio-inline">
                                {{ Form::radio('value', \App\Modules\Advert\Models\AdvertConfig::CUSTOM_MODE, null, ['class' => 'field']) }}
                                Custom
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

        <div class="text-center">

        </div>
    </div>
@endsection

