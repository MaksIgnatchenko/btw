<div class='box-tools'>
    <a href="{{ route('outcome.edit', $id) }}" class='btn btn-info'>
        <i class="glyphicon glyphicon-pencil"></i>
    </a>

    {!! Form::open(['route' => ['outcome.destroy', $id], 'method' => 'delete','class' => 'inline']) !!}

    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}

    {!! Form::close() !!}

</div>
