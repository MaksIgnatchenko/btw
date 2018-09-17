@extends('layouts.app')

@section('scripts')
    <script>
        function deleteReview(el) {
            if (confirm('Are you sure?')) {
                $(el).parent('form').submit();
            }
        }
    </script>
@endsection

@section('content')
    <section class="content-header">
        <h1>Merchant Review</h1>
        {{ Breadcrumbs::render('merchant-review', $merchantReview) }}

    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Merchant info</h3>
                    </div>
                    <div class="box-body">
                        @include('merchants.show_fields', ['merchant' => $merchantReview->merchant])
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Review details</h3>
                    </div>

                    <div class="box-body">


                    {!! Form::model($merchantReview, ['route' => ['review.merchants.update', $merchantReview->id], 'method' => 'put' , 'class' => 'form-horizontal']) !!}
                    <!-- Customer Field -->
                        <div class="form-group">
                            {!! Form::label('customer', 'Customer:', ['class'=> 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                <p class="form-control-static">
                                    <a href="{{route('customers.show', $merchantReview->customer->id)}}">
                                        {{$merchantReview->customer->first_name . ' ' .  $merchantReview->customer->last_name}}
                                    </a>
                                </p>
                            </div>
                        </div>

                        <!-- Status Field -->
                        <div class="form-group">
                            {!! Form::label('status', 'Status:', ['class'=> 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::select('status', ReviewStatusEnum::toArray(), $merchantReview->status, ['class' => 'form-control'])!!}
                                @if ($errors->has('status'))
                                    <div class="text-red">{{ $errors->first('status') }}</div>
                                @endif
                            </div>
                        </div>

                        <!-- Rate Field -->
                        <div class="form-group">
                            {!! Form::label('rate', 'Rate:', ['class'=> 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::select('rate', ReviewRateEnum::toArray(), $merchantReview->rate, ['class' => 'form-control'])!!}
                                @if ($errors->has('rate'))
                                    <div class="text-red">{{ $errors->first('parameters') }}</div>
                                @endif
                            </div>
                        </div>

                        <!-- Review Field -->
                        <div class="form-group">
                            {!! Form::label('review', 'Review:',  ['class'=> 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::textarea('review', null, ['class' => 'form-control',  'size' => '30x5','style' => 'resize:none']) !!}
                                @if ($errors->has('review'))
                                    <div class="text-red">{{ $errors->first('review') }}</div>
                                @endif
                            </div>
                        </div>

                        <!-- Submit Field -->
                        <div class="text-right">

                            {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                            {!! Form::close() !!}

                            {!! Form::open(['route' => ['review.merchants.delete', $merchantReview->id], 'method' => 'delete','class' => 'inline']) !!}
                            <a href="#" class="btn btn-danger" onclick="deleteReview(this)" data-toggle="tooltip"
                               title="Delete review">
                                Delete review
                            </a>
                            {!! Form::close() !!}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
