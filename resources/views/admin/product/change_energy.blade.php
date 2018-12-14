@if ($value == config('custom.min'))
    {{ Form::select('energy', $energy, '' ,['class' => 'form-control', 'required']) }}
@else
    {!! Form::text('energy', '', ['required', 'autofocus', 'class' => 'form-control']) !!}
@endif
