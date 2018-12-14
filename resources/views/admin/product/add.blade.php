@extends('templates.admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid m-b-50">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">
                        @lang('message.admin.add_product')
                    </h2>
                    @include('errors.error')
                    {!! Form::open(['route' => 'product.store', 'method' => 'post', 'role' => 'form', 'files' => true]) !!}
                        <div class="col-lg-12">
                            <div class="col-lg-6 form-group">
                                {!! Form::label('name', trans('message.product.name_product')) !!}
                                {!! Form::text('name', '', ['required', 'autofocus', 'class' => 'form-control'. ($errors->has('email') ? ' is-invalid' : '')]) !!}
                            </div>
                            <div class="col-lg-6 form-group">
                                {!! Form::label('price', trans('message.product.price'))." ".(config('custom.vnd') ) !!}
                                {!! Form::number('price', null,  ['required', 'min' => config('custom.zero'),
                                    'autofocus', 'class' => 'form-control']) !!}
                            </div>

                        </div>
                        <div class="col-lg-12 form-group">
                            <div class="col-lg-6">
                                {!! Form::label('strap', trans('message.product.strap_type')) !!}
                                {{ Form::radio('strap', config('custom.min'), true) }} <span>@lang('message.admin.select_old_type')</span>
                                {{ Form::radio('strap', config('custom.two')) }} <span>@lang('message.admin.create_new')</span>
                                <div class="data-strap">
                                    {{ Form::select('strap', $strap_type, '' ,['class' => 'form-control', 'required']) }}
                                </div>
                                {{ Form::hidden('route_strap', route('product.change_strap'), ['class' => 'route_strap']) }}
                            </div>
                            <div class="col-lg-6 ">
                                {!! Form::label('skin', trans('message.product.skin_type')) !!}
                                {{ Form::radio('skin', config('custom.min'), true) }} <span>@lang('message.admin.select_old_type')</span>
                                {{ Form::radio('skin', config('custom.two')) }} <span>@lang('message.admin.create_new')</span>
                                <div class="data-skin">
                                    {{ Form::select('skin', $skin_type, '' ,['class' => 'form-control', 'required']) }}
                                </div>
                                {{ Form::hidden('route_skin', route('product.change_skin'), ['class' => 'route_skin']) }}
                            </div>
                        </div>
                        <div class="col-lg-12 form-group">
                            <div class="col-lg-6">
                                {!! Form::label('energy', trans('message.product.energy')) !!}
                                {{ Form::radio('energy', config('custom.min'), true) }} <span>@lang('message.admin.select_old_type')</span>
                                {{ Form::radio('energy', config('custom.two')) }} <span>@lang('message.admin.create_new')</span>
                                <div class="data-energy">
                                    {{ Form::select('energy', $energy, '' ,['class' => 'form-control', 'required']) }}
                                </div>
                                {{ Form::hidden('route_energy', route('product.change_energy'), ['class' => 'route_energy']) }}
                            </div>
                            <div class="col-lg-6">
                                {!! Form::label('picture', trans('message.admin.choose_pic')) !!}
                                {!! Form::file('picture', ['required']) !!}
                            </div>

                        </div>
                        <div class="col-lg-12 form-group">
                            <div class="col-lg-6">
                                {!! Form::label('preview', trans('message.admin.preview')) !!}
                                {{ Form::textarea('preview', null, ['class' => 'form-control', 'rows' => config('custom.rows')]) }}
                            </div>
                            <div class="col-lg-6">
                                {!! Form::label('description', trans('message.admin.description')) !!}
                                {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => config('custom.rows')]) }}
                            </div>
                        </div>
                        <div class="col-lg-12 form-group">
                            <div class="col-lg-6">
                                {!! Form::label('category', trans('message.admin.category_parent')) !!}
                                {{ Form::select('category', $categories, '' ,['class' => 'form-control select-category', 'required']) }}
                            </div>
                            {{ Form::hidden('route_category', Route('product.change_category'), ['class' => 'route_category']) }}
                            <div class="col-lg-6 sub-category">

                            </div>
                        </div>

                        <div class='col-lg-12 form-group'>
                            <div class="col-lg-6">
                                {!! Form::submit(trans('message.admin.add') , ['class' => 'btn btn-success']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
