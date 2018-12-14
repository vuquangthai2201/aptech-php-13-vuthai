@if ($order->status == config('custom.min'))
    <p class="btn btn-warning">@lang('message.delivering')</p>
@else
    <p class="btn btn-success">@lang('message.delivered')</p>
@endif
