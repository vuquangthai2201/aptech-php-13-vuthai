@if ($value == config('custom.min'))
    {{ Form::select('skin', $skin_type, '' ,['class' => 'form-control', 'required']) }}
@else
    {!! Form::text('skin', '', ['required', 'autofocus', 'class' => 'form-control']) !!}
@endif
