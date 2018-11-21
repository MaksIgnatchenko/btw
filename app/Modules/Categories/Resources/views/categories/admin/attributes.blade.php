<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Category attributes</h3>
    </div>
    <div class="box-body">

        <div id="attributes">
            <table class="table table-bordered">
                <tfoot>
                <tr>
                    @if ($errors->has('attributes'))
                        <div class="text-red">{{ $errors->first('attributes') }}</div>
                    @endif
                </tr>
                </tfoot>
                <tbody>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>

                @php ($displayingAttributes = DisplayValues::getAttributes($category ?? null, old('attributes')))
                @foreach($displayingAttributes as $attribute)
                    <tr>

                        <td>{{$attribute['name']}}</td>
                        <td>{{DisplayValues::getAttributeTypeText($attribute)}}</td>

                        <td>
                            <button type="button" class="btn btn-default" id="edit-attribute">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-danger" id="drop-attribute">
                                <i class="fa fa-times"></i>
                            </button>
                        </td>

                        <input type="hidden" name="attributes[]"
                               value='{{json_encode($attribute)}}'>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="form-group">
            <div class="pull-right">
                <button type="button" class="btn btn-primary"
                        id="add-attribute-button">
                    Add attribute
                </button>
            </div>


            <div class="modal fade" id="add-attribute-modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Add attribute</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group row">
                                        {!! Form::label('attribute-name', 'Name:', ['class' => 'col-sm-2 control-label']) !!}
                                        <div class="col-sm-10">
                                            {!! Form::text('attribute-name', null, ['class' => 'form-control', 'placeholder' => 'Size']) !!}
                                            <div class="text-red" id="add-attribute-name-error"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        {{ Form::label('attribute-type', 'Type: ', ['class' => 'col-sm-2 control-label']) }}
                                        <div class="col-sm-10">
                                            {!! Form::select('attribute-type',
                                            DisplayValues::getAttributesData(),
                                            DisplayValues::getDefaultAttribute(),
                                            ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary" id="add-attribute">
                                Add
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="edit-attribute-modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Edit attribute</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-horizontal">
                                <div class="box-body">
                                    <input type="hidden" id="edit-old-name" value="">
                                    <div class="form-group">
                                        {!! Form::label('edit-attribute-name', 'Name:', ['class' => 'col-sm-2 control-label']) !!}

                                        <div class="col-sm-10">
                                            {!! Form::text('edit-attribute-name', null, ['class' => 'form-control', 'placeholder' => 'Size']) !!}
                                            <div class="text-red" id="edit-attribute-name-error"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('edit-attribute-type', 'Type: ', ['class' => 'col-sm-2 control-label']) }}

                                        <div class="col-sm-10">
                                            {!! Form::select('edit-attribute-type',
                                            DisplayValues::getAttributesData(),
                                            DisplayValues::getDefaultAttribute(),
                                            ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary" id="save-edit-attribute">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
