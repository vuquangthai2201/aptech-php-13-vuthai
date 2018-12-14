@extends('templates.admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid m-b-50">
            <div class="row">
                <div class="col-lg-12">
                    <h2><i class="fa fa-shopping-cart"></i> @lang('message.admin.order')</h2>
                    @include('errors.error')
                    <br >
                    <br >
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <th>@lang('message.product.total') {{ config('custom.vnd') }}</th>
                                <th>@lang('message.admin.payment_type')</th>
                                <th>@lang('message.order_at')</th>
                                <th>@lang('message.admin.name_customer')</th>
                                <th>@lang('message.status')</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{ number_format($order->total_price) }}  {{ config('custom.vnd') }}</td>
                                    <td>{{ $order->payment_type }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->customer->name }}</td>
                                    @if ($order->status == config('custom.zero'))
                                    <td>
                                        <a href="{{ route('order.confirm', $order->id) }}" class="btn btn-danger">@lang('message.unconfirm')</a>
                                    </td>
                                    @else
                                    <td class="status-click" id='{{ $order->id }}'>
                                        @if ($order->status == config('custom.min'))
                                            <p class="btn btn-warning">@lang('message.delivering')</p>
                                        @else
                                            <p class="btn btn-success">@lang('message.delivered')</p>
                                        @endif
                                    </td>
                                    @endif
                                    {{ Form::hidden('route', route('order.status'), ['class' => 'route_order']) }}
                                    <td>
                                        <a class="btn btn-info" href="{{ route('order.show', $order->id) }}">@lang('message.admin.view_detail')</a>
                                        {!! Form::open(['route' => ['order.destroy', $order->id], 'method' => 'delete', 'onsubmit' => 'return confirm('.trans('message.are_u_sure').')']) !!}
                                            {{ Form::submit(trans('message.delete'), ['class' => 'btn btn-danger']) }}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
