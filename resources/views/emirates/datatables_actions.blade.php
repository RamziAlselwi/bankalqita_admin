<div class='btn-group btn-group-sm'>

    <a data-toggle="tooltip" data-placement="bottom" title="تعديل الاماره"
        href="{{ route('emirates.edit', $id) }}" class='btn btn-link'>
        <i class="ik ik-edit-2 f-16 mr-15 text-green"></i>
    </a>
    
    {!! Form::open(['route' => ['emirates.destroy', $id], 'method' => 'delete']) !!}
    {!! Form::button('<i class="ik ik-trash-2 f-16 text-red"></i>', [
    'type' => 'submit',
    'class' => 'btn btn-link text-danger',
    'onclick' => "return confirm('هل انت متاكد؟')"
    ]) !!}
    {!! Form::close() !!}
</div>
