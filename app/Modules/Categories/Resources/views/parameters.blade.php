<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Category parameters</h3>
    </div>
    <div class="box-body">

        <div id="parameters">
            <table class="table table-bordered">
                <tfoot>
                <tr>
                    @if ($errors->has('parameters'))
                        <div class="text-red">{{ $errors->first('parameters') }}</div>
                    @endif
                </tr>
                </tfoot>
                <tbody>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>

                @php ($displayingParameters = DisplayValues::getParameters($category ?? null, old('parameters')))
                @foreach($displayingParameters as $parameter)
                    <tr>

                        <td>{{DisplayValues::getParameterNameText($parameter)}}</td>

                        <td>
                            <button type="button" class="btn btn-default edit-parameter">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-danger drop-parameter">
                                <i class="fa fa-times"></i>
                            </button>
                        </td>

                        <input type="hidden" name="parameters[]"
                               value='{{$parameter}}'>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="form-group">
            <div class="pull-right">
                <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#add-parameter-modal">
                    Add parameter
                </button>
            </div>


            <div class="modal fade" id="add-parameter-modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Add parameter</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group">
                                        {{ Form::label('parameter-value', 'Value: ', ['class' => 'col-sm-2 control-label']) }}

                                        <div class="col-sm-10">
                                            {!! Form::select('parameter-value',
                                            DisplayValues::getParametersData(),
                                            DisplayValues::getDefaultParameter(),
                                            ['class' => 'form-control']) !!}
                                            <div class="text-red" id="add-parameter-value-error"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary" id="add-parameter">
                                Add
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="edit-parameter-modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Edit parameter</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-horizontal">
                                <div class="box-body">
                                    <input type="hidden" id="edit-old-parameter" value="">
                                    <div class="form-group">
                                        {{ Form::label('edit-parameter-value', 'Value: ', ['class' => 'col-sm-2 control-label']) }}

                                        <div class="col-sm-10">
                                            {!!
                                            Form::select('edit-parameter-value',
                                                DisplayValues::getParametersData(),
                                                DisplayValues::getDefaultParameter(),
                                                ['class' => 'form-control'])
                                                 !!}
                                            <div class="text-red" id="edit-parameter-value-error"></div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary" id="save-edit-parameter">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
