@if ($user->active == config('custom.zero'))
    <p class="btn btn-danger">@lang('message.admin.inactive')</p>
@else
    <p class="btn btn-success">@lang('message.admin.active')</p>
@endif
