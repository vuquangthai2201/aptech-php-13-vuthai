@extends('templates.admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid m-b-50">
            <div class="row">
                <div class="col-lg-12">
                    <h2><i class="fa fa-user"></i>  @lang('message.admin.user')</h2>
                    @include('errors.error')
                    <a href="{{ Route('user.create') }}" type="button" class="btn btn-info">@lang('message.admin.add')</a>
                    <br >
                    <br >
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <th>@lang('message.email_address')</th>
                                <th>@lang('message.name')</th>
                                <th>@lang('message.admin.role')</th>
                                <th>@lang('message.status')</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td><a href="">{{ $user->email }}</a></td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->role }}</td>
                                    @if ($user->email == config('custom.mail_admin'))
                                        <td>
                                            <p class="btn btn-success">@lang('message.admin.active')</p>
                                        </td>
                                    @else
                                        <td class="active-click" id='{{  $user->id }}'>
                                            @if ($user->active == config('custom.zero'))
                                                <p class="btn btn-danger">@lang('message.admin.inactive')</p>
                                            @else
                                                <p class="btn btn-success">@lang('message.admin.active')</p>
                                            @endif
                                            {{ Form::hidden('route', route('user.active'), ['class' => 'route_user']) }}
                                        </td>
                                    @endif
                                    <td>
                                        <a href="{{ Route('user.edit', [$user->id]) }}" class="btn btn-sm btn-primary"><i class='fa fa-pencil'></i> @lang('message.admin.edit')</a>

                                        @if ($user->email != config('custom.mail_admin'))
                                            {!! Form::open(['route' => ['user.destroy', $user->id], 'method' => 'delete', 'onsubmit' => 'return confirm("Are you sure?")']) !!}
                                                {{ Form::submit(trans('message.delete'), ['class' => 'btn btn-danger']) }}
                                            {!! Form::close() !!}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
