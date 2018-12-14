@if ($value == config('custom.min'))
    {{ Form::select('strap', $strap_type, '' ,['class' => 'form-control', 'required']) }}
@else
    {!! Form::text('strap', '', ['required', 'autofocus', 'class' => 'form-control']) !!}
@endif
