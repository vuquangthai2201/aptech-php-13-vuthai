@extends('templates.watch.master')
@section('content')
    <section class="slide1">
            {{ Html::image(asset('images/icons/slider.jpg')) }}
    </section>

    <section class="bgwhite p-t-55 p-b-65">
        <div class="container">
            <div class="row">
                @include('templates.watch.leftbar')

                <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
                    <div class="flex-sb-m flex-w p-b-35">
                        <div class="flex-w">
                            <div class="rs2-select2 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                                {{ Form::select('sorting', ['default' => trans('message.sort.default'), 'popularity' => trans('message.sort.popularity'), 'price_asc' => trans('message.sort.price_asc'),
                                'price_desc' => trans('message.sort.price_desc')], request()->input('sort') ? request()->input('sort') : 'default',['class' => 'selection-2']) }}
                            </div>
                        </div>

                        <span class="s-text8 p-t-5 p-b-5">
                        </span>
                    </div>

                    <div class="row">
                        @foreach ($products as $product)
                        <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                    {{ Html::image(asset("images/products/$product->picture")) }}

                                    <div class="block2-overlay trans-0-4">
                                        <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            {{ Form::button(trans('message.add_to_cart'), ['class' => 'flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4', 'onclick' => Auth::check() ? 'addcart('.$product->id.')' : '']) }}
                                            {{ Form::hidden('name', route('cart.create'), array('id' => $product->id)) }}
                                            {{ Form::hidden('change', route('cart.change'), array('id' => 'changecart-'.$product->id)) }}
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="{{route('product.detail',['name' => str_slug($product->name),'id' => $product->id])}}" class="block2-name dis-block s-text3 p-b-5">
                                        {{ $product->name }}
                                    </a>

                                    <span class="block2-price m-text6 p-r-5">
                                        <i class="fa fa-money"></i>  {{ number_format($product->price) }} {{ config('custom.vnd') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="pagination flex-m flex-w p-t-26">
                        {{ $products->appends(Request::all())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
