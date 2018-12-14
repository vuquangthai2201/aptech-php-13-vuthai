@extends('templates.watch.master')
@section('content')
    @if (count($products) > config('custom.zero'))
        <div class="panel panel-default">
            <div class="panel-heading">
            </div>

            <div class="panel-body">
                <table class="table table-striped product-table">

                    <thead>
                        <th>@lang('message.product.name_product')</th>
                        <th>@lang('message.product.price') ({{ config('custom.vnd') }})</th>
                        <th>@lang('message.product.quantity')</th>
                        <th>&nbsp;</th>
                        @php
                            $total = config('custom.zero');
                        @endphp
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td class="table-text">
                                    <div>{{ $product['name']}}</div>
                                </td>

                                <td>{{ $product['price'] }} {{ config('custom.vnd') }}</td>
                                <td>
                                    {!! Form::open(['route' => ['cart.update', $product['id_product']], 'method' => 'patch', 'id' => 'form-quantity-'.$product['id_product']]) !!}
                                        {{ Form::number('number',  $product['quantity'] , ['min' => config('custom.min'), 'id' => 'quantity-'.$product['id_product'],
                                        'onchange' => 'change('.$product['id_product'].')', 'class' => 'form-control', 'required']) }}
                                    {!! Form::close() !!}
                                </td>
                                <td>
                                    {!! Form::open(['route' => ['cart.destroy', $product['id_product']], 'method' => 'delete', 'onsubmit' => 'return confirm("Are you sure?")']) !!}
                                        {!! Form::submit(trans('message.delete'), ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @php
                            $total = $total + $product['price']*$product['quantity'];
                        @endphp
                        @endforeach
                            <tr>
                                <td colspan="3"></td>
                                <td>
                                    @lang('message.product.total'): {{ $total }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('cart.info') }}">@lang('message.check_out')</a>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="btn btn-warning">
            @lang('message.product.no_products')
        </div>
    @endif
@endsection
