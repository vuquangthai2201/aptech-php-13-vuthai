@extends('templates.admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid m-b-50">
            <div class="row">
                <div class="col-lg-12">
                    <h2><i class="fa fa-bars"></i> @lang('message.admin.category')</h2>
                    @include('errors.error')
                    <a href="{{ Route('category.create') }}" type="button" class="btn btn-info">@lang('message.admin.add')</a>
                    <br >
                    <br >
                    {{ Form::hidden('getLangugue', json_encode(trans('message'))) }}
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <th>@lang('message.name')</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td><a href="">{{ $category->name }}</a></td>
                                    <td>
                                        <a href="{{ Route('category.edit', [$category->id]) }}" class="btn btn-sm btn-primary">
                                            <i class='fa fa-pencil'></i> @lang('message.admin.edit')
                                        </a>
                                        {!! Form::open(['route' => ['category.destroy', $category->id], 'method' => 'delete', 'class' => 'click-submit-cat']) !!}
                                            {{ Form::submit(trans('message.delete'), ['class' => 'btn btn-danger']) }}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @if ($category->children)
                                    @foreach($category->children as $cat_child)
                                        <tr>
                                            <td><a href="">------ {{ $cat_child->name }}</a></td>
                                            <td>
                                                <a href="{{ Route('category.edit', [$cat_child->id]) }}" class="btn btn-sm btn-primary">
                                                    <i class='fa fa-pencil'></i> @lang('message.admin.edit')
                                                </a>
                                                {!! Form::open(['route' => ['category.destroy', $category->id], 'method' => 'delete', 'class' => 'click-confirm-del']) !!}
                                                    {{ Form::submit(trans('message.delete'), ['class' => 'btn btn-danger']) }}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
