@extends('layouts.app')

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/js/Csv/index.js"></script>
@endsection

@section('content')
    <section class="content-header">
        <h1>Csv generator</h1>
        {{Breadcrumbs::render('csv')}}
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Csv generator</h3>
                    </div>
                    <div class="box-body">

                        {!! Form::open(['route' => ['csv.show', 'generate'], 'method' => 'get' , 'class' => 'form-horizontal']) !!}

                        <div class="form-group">
                            {!! Form::label('type', 'Type:', ['class'=> 'control-label col-sm-2']) !!}

                            <div class="col-sm-10">
                                {!! Form::select('type', CsvGeneratorTypeEnum::toArray(), null, [
                                    'class' => 'form-control',
                                ])!!}
                                @if ($errors->has('type'))
                                    <div class="text-red">{{ $errors->first('type') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('date_from', 'Date from:', ['class'=> 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('date_from', null, ['class' => 'form-control'])!!}
                                @if ($errors->has('date_from'))
                                    <div class="text-red">{{ $errors->first('date_from') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('date_to', 'Date to:', ['class'=> 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('date_to', null, ['class' => 'form-control'])!!}
                                @if ($errors->has('date_to'))
                                    <div class="text-red">{{ $errors->first('date_to') }}</div>
                                @endif
                            </div>
                        </div>

                        {!! Form::submit('Generate', ['class' => 'btn btn-success']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
