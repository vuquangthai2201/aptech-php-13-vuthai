<!DOCTYPE html>
<html>
<head>
    <title></title>
    {{ Html::style(asset('css/admin.css')) }}
</head>
<body>
    <div class="container">
        <h1>@lang('message.name_shop')</h1>
        <h2>@lang('message.order_number'): {{ $order->id }}</h2>
        <div class="row panel panel-default">
            <div class="alert alert-success col-md-12 p-b-30">
                <h4 class="m-text26 p-b-36 p-t-15">
                    @lang('message.infor_customer'):
                </h4>
                <p>
                    <span>
                        @lang('message.name') :
                        <strong>{{ $order->name }}</strong>
                    </span>
                </p>

                <p>
                    <span>
                        @lang('message.phone') :
                        <strong>{{ $order->phone }}</strong>
                    </span>
                </p>
                <p>
                    <span>
                        @lang('message.address') :
                        <strong>{{ $order->address }}</strong>
                    </span>
                </p>
                <p>
                    <span>
                        @lang('message.order_at') :
                        <strong>{{ $order->created_at }}</strong>
                    </span>
                </p>
            </div>


            <div class="alert alert-info">
                <div>
                    <table class="table table-striped product-table">
                        <thead>
                            <th>@lang('message.product.name_product')</th>
                            <th>@lang('message.product.quantity')</th>
                            <th>@lang('message.product.price') ({{ config('custom.vnd') }})</th>
                        </thead>
                        <tbody>
                            @foreach ($order->orderdetails as $orderdetail)
                                <tr>
                                    <td class="table-text">
                                        <div>{{ $orderdetail->name_product}}</div>
                                    </td>
                                    <td>{{ $orderdetail->quantity }}</td>
                                    <td>{{ number_format($orderdetail->price) }} {{ config('custom.vnd') }}</td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td colspan="2"></td>
                                    <td>
                                        @lang('message.product.total'): {{ number_format($order->total_price) }} {{ config('custom.vnd') }}
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="alert alert-warning">
                <p>
                    <span>
                        @lang('message.admin.payment_type'):
                        <strong>{{ $order->payment_type }}</strong>
                    </span>
                </p>
            </div>
            <div>
                <h2>@lang('message.pls_review_confirm')</h2>
                <a href="{{ route('order.confirm', $order->id) }}">@lang('message.confirm')</p>
            </div>
        </div>
    </div>
</body>
</html>
