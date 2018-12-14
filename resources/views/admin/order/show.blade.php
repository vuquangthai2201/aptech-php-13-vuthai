@extends('templates.admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid m-b-50">
            <div class="row">
                <div class="col-lg-12">
                    <h2><i class="fa fa-shopping-cart"></i> @lang('message.admin.order_detail')</h2>
                    <br >
                    <br >
                    <div class="col-md-12 m-b-50 panel panel-default">
                        <div class="panel-heading">
                            <p>
                                <span class="m-r-30">@lang('message.order_number'): <strong>{{ $order->id }}</strong></span>
                                <span class="m-r-30">@lang('message.order_at'): <strong>{{ $order->created_at }}</strong></span>
                                <span>@lang('message.status'):
                                    <strong>
                                        {{ $order->status == config('custom.zero') ? trans('message.unconfirm') : ($order->status == config('custom.min') ? trans('message.delivering') : trans('message.delivered')) }}
                                    </strong>
                                </span>
                            </p>
                        </div>

                        <div class="panel-body">
                            <table class="table table-striped product-table">
                                <thead>
                                    <th>@lang('message.product.name_product')</th>
                                    <th>@lang('message.product.picture')</th>
                                    <th>@lang('message.product.quantity')</th>
                                    <th>@lang('message.product.price') ({{ config('custom.vnd') }})</th>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderdetails as $orderdetail)
                                        <tr>
                                            <td class="table-text">
                                                <div>{{ $orderdetail->name_product }}</div>
                                            </td>
                                            <td>
                                                <div class="product-img">
                                                    {{ Html::image(asset("images/products/".$orderdetail->product->picture)) }}
                                                </div>
                                            </td>
                                            <td>{{ $orderdetail->quantity }}</td>
                                            <td>{{ number_format($orderdetail->price) }} {{ config('custom.vnd') }}</td>
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
                    <div>
                        @if ($order->status == config('custom.zero'))
                            <a href="{{ route('order.confirm', $order->id) }}" class="btn btn-warning">@lang('message.unconfirm')</a>
                        @endif
                        {!! Form::open(['route' => ['order.destroy', $order->id], 'method' => 'delete', 'onsubmit' => 'return confirm('.trans('message.are_u_sure').')']) !!}
                            {{ Form::submit(trans('message.delete'), ['class' => 'btn btn-danger']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
