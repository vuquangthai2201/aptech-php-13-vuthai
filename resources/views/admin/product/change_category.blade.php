{!! Form::label('sub_category', trans('message.admin.sub_cat')) !!}
{{ Form::select('sub_category', $sub_categories, '' ,['class' => 'form-control', 'required']) }}
