<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <h1>@lang('message.review_these_orders')</h1>
    @foreach ($orders as $order)
        <h4>@lang('message.order_number'): {{ $order->id }}</h4>
    @endforeach
    <h4>
        <strong>
            @lang('message.product.total'): {{ count($orders) }}
        </strong>
    </h4>
</body>
</html>
