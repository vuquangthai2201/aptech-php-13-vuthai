@extends('templates.watch.master')
@section('content')
    <section class="bgwhite p-t-66 p-b-60">
        <div class="container">
            @include('errors.error')
            <h4 class="m-text26 p-b-36 p-t-15 t-center">
                @lang('message.your_infor')
            </h4>
            <div class="row">
                <div class="profile-img col-md-4 p-b-30">
                    @if ($user->customers != null && $user->customers->avatar != null)
                    {{ Html::image(asset('../storage/app/images/users/'.$user->customers->avatar)) }}
                    @endif
                </div>
                <div class="col-md-8 p-b-30">
                    {!! Form::open(['method' => 'patch', 'route' => ['profile.update', Auth::user()->id], 'class' => 'leave-profile', 'files' => true]) !!}
                        {!! Form::label('name', trans('message.name'), ['class' => 'col-form-label text-md-right']) !!}
                        <div class="bo4 of-hidden size15 m-b-20">
                            {!! Form::text('name', $user->name, ['required', 'class' => 'sizefull s-text7 p-l-22 p-r-22']) !!}
                        </div>

                        {!! Form::label('email', trans('message.email_address'), ['class' => 'col-form-label text-md-right']) !!}
                        <div class="bo4 of-hidden size15 m-b-20">
                            {!! Form::text('email', $user->email, ['required', 'class' => 'sizefull s-text7 p-l-22 p-r-22']) !!}
                        </div>

                        {!! Form::label('password', trans('message.new_password'), ['class' => 'col-form-label text-md-right']) !!}
                        <div class="bo4 of-hidden size15 m-b-20">
                            {!! Form::password('password', ['id' => 'password_profile', 'class' => 'sizefull p-l-22 p-r-22']) !!}
                        </div>

                        {!! Form::label('confirm_password', trans('message.confirm_new_password'), ['class' => 'col-form-label text-md-right']) !!}
                        <div class="bo4 of-hidden size15 m-b-20">
                            {!! Form::password('confirm_password', ['id' => 'confirm_password_profile', 'class' => 'sizefull p-l-22 p-r-22']) !!}
                        </div>
                        @if ($user->customers != null)
                            {!! Form::label('phone', trans('message.phone'), ['class' => 'col-form-label text-md-right']) !!}
                            <div class="bo4 of-hidden size15 m-b-20">
                                {!! Form::text('phone', $user->customers->phone, ['required', 'class' => 'sizefull s-text7 p-l-22 p-r-22']) !!}
                            </div>

                            {!! Form::label('address', trans('message.address'), ['class' => 'col-form-label text-md-right']) !!}
                            <div class="bo4 of-hidden size20 m-b-20">
                                {!! Form::textarea('address', $user->customers->address, ['class' => 'dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13',
                                'rows' => config('custom.rows'), 'required']) !!}
                            </div>

                            {!! Form::label('avatar', trans('message.change_avatar'), ['class' => 'col-form-label text-md-right']) !!}
                            <div class=" of-hidden size15 m-b-20">
                                {!! Form::file('avatar') !!}
                            </div>
                        @else
                            <p class="alert alert-info">
                                @lang('message.please_buy')
                            </p>
                        @endif
                        <div class="w-size25">
                            {{ Form::submit(trans('message.confirm'), ['class' => 'flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4']) }}
                        </div>
                </div>
                <div class="clear"></div>
                {!! Form::close() !!}

            </div>
        </div>
    </section>
@endsection
