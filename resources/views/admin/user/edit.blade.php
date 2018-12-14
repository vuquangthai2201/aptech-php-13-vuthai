@extends('templates.admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid m-b-50">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">
                        @lang('message.admin.edit_user')
                    </h2>
                    @include('errors.error')
                    {!! Form::open(['route' => ['user.update', $user->id], 'method' => 'PATCH', 'role' => 'form']) !!}
                        <div class="col-lg-12">
                            <div class="col-lg-6 form-group">
                                {!! Form::label('email', trans('message.email_address')) !!}
                                {!! Form::email('email', $user->email, ['required', 'autofocus',
                                    'class' => 'form-control'. ($errors->has('email') ? ' is-invalid' : '')]) !!}
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-6 form-group">
                                {!! Form::label('name', trans('message.name')) !!}
                                {!! Form::text('name', $user->name, ['required', 'autofocus',
                                    'class' => 'form-control'. ($errors->has('email') ? ' is-invalid' : '')]) !!}
                            </div>
                        </div>
                        <div class='col-lg-12'>
                            <div class="col-lg-6">
                                {!! Form::submit(trans('message.admin.edit'), ['class' => 'btn btn-success']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
