@extends('templates.watch.master')
@section('content')
    <section class="bgwhite p-t-66 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-8 p-b-30">
                    {!! Form::open(['route' => 'cart.confirm', 'method' => 'post', 'class' => 'leave-comment']) !!}
                        <h4 class="m-text26 p-b-36 p-t-15">
                            @lang('message.input_your_infor')
                        </h4>
                        {!! Form::label('name', trans('message.name'), ['class' => 'col-form-label text-md-right']) !!}
                        <div class="bo4 of-hidden size15 m-b-20">
                            {!! Form::text('name', $count > config('custom.zero') ? $customer->name : '', ['required', 'class' => 'sizefull s-text7 p-l-22 p-r-22']) !!}
                        </div>

                        {!! Form::label('phone', trans('message.phone'), ['class' => 'col-form-label text-md-right']) !!}
                        <div class="bo4 of-hidden size15 m-b-20">
                            {!! Form::text('phone', $count > config('custom.zero') ? $customer->phone : '', ['required', 'class' => 'sizefull s-text7 p-l-22 p-r-22']) !!}
                        </div>

                        {!! Form::label('address', trans('message.address'), ['class' => 'col-form-label text-md-right']) !!}
                        <div class="bo4 of-hidden size20 m-b-20">
                            {!! Form::textarea('address', $count > config('custom.zero') ? $customer->address : '', ['class' => 'dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13',
                            'rows' => config('custom.rows'), 'cols' => config('custom.cols'), 'required']) !!}
                        </div>

                        <div class="w-size25">
                            {{ Form::submit(trans('message.next'), ['class' => 'flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4']) }}
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="clear"></div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-striped product-table">

                            <thead>
                                <th>@lang('message.product.name_product')</th>
                                <th>@lang('message.product.price') ({{ config('custom.vnd') }})</th>
                                <th>@lang('message.product.quantity')</th>
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
                                        <td>{{ $product['quantity'] }}</td>
                                    </tr>
                                @php
                                    $total = $total + $product['price'] * $product['quantity'];
                                @endphp
                                @endforeach
                                    <tr>
                                        <td colspan="2"></td>
                                        <td>
                                            @lang('message.product.total'): {{ $total }}
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
