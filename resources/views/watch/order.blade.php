@extends('templates.watch.master')
@section('content')
<section class="bgwhite p-t-66 p-b-60">
    <div class="container">
        <div class="row">
            <p class="p-b-10">@lang('message.number_your_order'): <strong>{{ count($orders) }}</strong></p>
            @foreach ($orders as $order)
            <div class="col-md-12 m-b-50 panel panel-default">
                <div class="panel-heading">
                    <p>
                        <span class="m-r-30">@lang('message.order_number'): <strong>{{ $order->id }}</strong></span>
                        <span class="m-r-30">@lang('message.order_at'): <strong>{{ $order->created_at }}</strong></span>
                        <span>@lang('message.status'):
                            <strong>{{ $order->status == config('custom.zero') ? trans('message.unconfirm') :
                                ($order->status == config('custom.min') ? trans('message.delivering') : trans('message.delivered')) }}
                            </strong>
                        </span>
                    </p>
                </div>

                <div class="panel-body">
                    <table class="table table-striped product-table">
                        <thead>
                            <th>@lang('message.product.name_product')</th>
                            <th>@lang('message.product.picture')</th>
                            <th>@lang('message.product.price') ({{ config('custom.vnd') }})</th>
                            <th>@lang('message.product.quantity')</th>
                        </thead>
                        <tbody>
                            @foreach ($order->orderdetails as $orderdetail)
                                <tr>
                                    <td class="table-text">
                                        <div>{{ $orderdetail->name_product }}</div>
                                    </td>
                                    <td>
                                        <div class="img_product">
                                            {{ Html::image(asset("images/products/".$orderdetail->product->picture)) }}
                                        </div>
                                    </td>
                                    <td>{{ number_format($orderdetail->price) }} {{ config('custom.vnd') }}</td>
                                    <td>{{ $orderdetail->quantity }}</td>
                                </tr>
                            @endforeach

                                <tr>
                                    <td colspan="3"></td>
                                    <td>
                                        @lang('message.product.total'): {{ number_format($order->total_price) }} {{ config('custom.vnd') }}
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
