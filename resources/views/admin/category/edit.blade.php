@extends('templates.admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid m-b-50">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">
                        @lang('message.admin.edit_cat')
                    </h2>
                    @include('errors.error')
                    {!! Form::open(['route' => ['category.update', $category->id], 'method' => 'patch', 'role' => 'form']) !!}
                        <div class="col-lg-12">
                            <div class="col-lg-6 form-group">
                                {!! Form::label('name', trans('message.name')) !!}
                                {!! Form::text('name', $category->name, ['required', 'autofocus', 'class' => 'form-control']) !!}
                            </div>
                            <div class="col-lg-6 form-group">
                                {!! Form::label('parent_id', trans('message.admin.category_parent')) !!}
                                {{ Form::select('parent_id', $categories, $category->parent_id, ['class' => 'form-control select-category', 'required']) }}
                            </div>
                            <div class='col-lg-12 form-group'>
                                <div class="col-lg-6">
                                    {!! Form::submit(trans('message.admin.edit'), ['class' => 'btn btn-success']) !!}
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
