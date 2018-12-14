@extends('templates.admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid m-b-50">
            <div class="row">
                <div class="col-lg-12">
                    <h2><i class="fa fa-book"></i>  @lang('message.admin.product')</h2>
                    @include('errors.error')
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ Route('product.create') }}" type="button" class="btn btn-info">@lang('message.admin.add')</a>
                        </div>

                        <div class="col-md-8">
                            {!! Form::open(['route' => 'product.import', 'method' => 'post', 'files' => true]) !!}
                                <div class="col-lg-6 form-group">
                                    {!! Form::file('csv') !!}
                                </div>
                                <div class='col-lg-6 form-group'>
                                        {!! Form::submit('Import data', ['class' => 'btn btn-success']) !!}
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <br >
                    {{ Form::hidden('getLangugue', json_encode(trans('message'))) }}
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <th>@lang('message.name')</th>
                                <th>@lang('message.product.picture')</th>
                                <th>@lang('message.admin.category')</th>
                                <th>@lang('message.product.price') {{ config('custom.vnd') }}</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td><a href="">{{ $product->name }}</a></td>
                                    <td class="product-img">
                                        {{ Html::image(asset("images/products/$product->picture")) }}
                                    </td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ number_format($product->price) }}</td>
                                    <td>
                                        <a href="{{ Route('product.edit', [$product->id]) }}" class="btn btn-sm btn-primary">
                                            <i class='fa fa-pencil'></i> @lang('message.admin.edit')
                                        </a>
                                        {!! Form::open(['route' => ['product.destroy', $product->id], 'method' => 'delete', 'class' => 'click-confirm-del']) !!}
                                            {{ Form::submit(trans('message.delete'), ['class' => 'btn btn-danger']) }}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
