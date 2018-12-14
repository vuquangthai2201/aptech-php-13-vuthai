@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('message.login')</div>
                @include('errors.error')

                <div class="card-body">
                    {!! Form::open(['route' => 'login', 'method' => 'post']) !!}

                        <div class="form-group row">
                            {!! Form::label('email', trans('message.email_address'), ['class' => 'col-sm-4 col-form-label text-md-right']) !!}

                            <div class="col-md-6">
                                {!! Form::email('email', old('email'), ['id' => 'email', 'required', 'autofocus', 'class' => 'form-control'. ($errors->has('email') ? ' is-invalid' : '')]) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('password', trans('message.password'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}

                            <div class="col-md-6">
                                {!! Form::password('password', ['id' => 'password', 'required', 'class' => 'form-control'. ($errors->has('password') ? ' is-invalid' : '')]) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    {!! Form::checkbox('remember', '', (old('remember') ? 'checked' : ''), ['id' => 'remember', 'class' => 'form-check-input']) !!}

                                    {!! Form::label('remember', trans('message.remember'), ['class' => 'form-check-label']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                {!! Form::submit(trans('message.login'), ['class' => 'btn btn-primary']) !!}

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    @lang('message.forgot_password')
                                </a>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <a href="{{ route('social.login', 'facebook') }}"><i class="fa fa-facebook"></i> @lang('message.login_with_fb')</a>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <a href="{{ route('social.login', 'google') }}"> <i class="fa fa-google"></i> @lang('message.login_with_gg')</a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
