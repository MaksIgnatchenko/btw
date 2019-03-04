@extends('layouts.app')
@section('title', 'Management')
@section('content')

    <div class="breadcrumb-container pull-right">
        {{ Breadcrumbs::render('merchant', $merchant) }}
    </div>

    <div class="content">

        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="row">

            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Merchant details</h3>
                    </div>
                    <div class="box-body">
                        @include('merchants.admin.show_fields')
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Merchant company details</h3>
                    </div>
                    <div class="box-body">
                        @include('merchants.admin.company_info')
                    </div>
                </div>
            </div>

        </div>

    </div>
    <script>
        $(function() {
            $('#user_status_select').on('change', function () {
                console.log('ping')
                $.ajax($(this).data('userUrl'), {
                    method : 'POST',
                    data : {
                        _method: 'PUT',
                        _token: '{{csrf_token()}}',
                        status : $('option:selected', this).val()
                    },
                    success: function(){
                        location.reload();
                    }
                })
            });
        });
    </script>
@endsection