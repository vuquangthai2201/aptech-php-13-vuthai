<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <h1>@lang('message.statistic_month') {{ $data['month'] }}</h1>

    <h3>
        @lang('message.total_orders') : <strong>{{ $data['countOrder'] }}</strong> @lang('message.admin.order')
    </h3>
    <h3>
        @lang('message.total_orders_unconfirm') : <strong>{{ $data['countUnconfirm'] }}</strong> @lang('message.admin.order')
    </h3>
    <h3>
        @lang('message.total_orders_delivering') : <strong>{{ $data['countDelivering'] }}</strong> @lang('message.admin.order')
    </h3>
    <h3>
        @lang('message.total_revenue') : <strong>{{ number_format($data['getRevenue']) }}</strong> {{ config('custom.vnd') }}
    </h3>
</body>
</html>
