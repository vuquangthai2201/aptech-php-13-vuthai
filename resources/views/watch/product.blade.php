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
                        <th>@lang('message.product.energy')</th>
                        <th>@lang('message.product.strap_type')</th>
                        <th>@lang('message.product.skin_type')</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td class="table-text">
                                    <div>{{ $product->name }}</div>
                                </td>

                                <td>{{ $product->price }} {{ config('custom.vnd') }}</td>
                                <td>{{ $product->energy }}</td>
                                <td>{{ $product->strap_type }}</td>
                                <td>{{ $product->skin_type }}</td>
                                <td>
                                    <a href="javascript:;" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" id="{{route('cart.create')}}" {{ Auth::check()? 'onclick=addcart('.$product->id.')': '' }}>@lang('message.add_to_cart')
                                        {{ Form::hidden('name', route('cart.create'), array('id' => $product->id)) }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$products->appends(Request::all())->links()}}
        </div>
    @endif
@endsection
