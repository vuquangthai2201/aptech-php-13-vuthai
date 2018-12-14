@extends('templates.watch.master')
@section('content')
    <section class="slide1">
            {{ Html::image(asset('images/icons/slider.jpg')) }}
    </section>

    <section class="newproduct bgwhite p-t-45 p-b-105">
        <div class="container">
            <div class="sec-title p-b-60">
                <h3 class="m-text5 t-center">
                    @lang('message.featured_product')
                </h3>
            </div>

            <div class="wrap-slick2">
                <div class="slick2">
                    @foreach ($trend_products as $product)
                    <div class="item-slick2 p-l-15 p-r-15">
                        <div class="block2">
                            <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                {{ Html::image(asset("images/products/$product->picture")) }}

                                <div class="block2-overlay trans-0-4">
                                    <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                        <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                        <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                    </a>

                                    <div class="block2-btn-addcart w-size1 trans-0-4">
                                        <a href="javascript:;" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" {{ Auth::check()? 'onclick=addcart('.$product->id.')': '' }}>@lang('message.add_to_cart')
                                            {{ Form::hidden('name', route('cart.create'), array('id' => $product->id)) }}
                                            {{ Form::hidden('change', route('cart.change'), array('id' => 'changecart-'.$product->id)) }}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="block2-txt p-t-20">
                                <a href="{{route('product.detail',['name' => str_slug($product->name),'id' => $product->id])}}" class="block2-name dis-block s-text3 p-b-5">{{ $product->name }}
                                </a>

                                <span class="block2-price m-text6 p-r-5">
                                  <i class="fa fa-money"></i>  {{ number_format($product->price) }} {{ config('custom.vnd') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    <section class="newproduct bgwhite p-t-45 p-b-105">
        <div class="container">
            <div class="sec-title p-b-60">
                <h3 class="m-text5 t-center">
                    @lang('message.new_product')
                </h3>
            </div>

            <div class="wrap-slick4">
                <div class="slick4">
                    @foreach ($new_products as $product)
                    <div class="item-slick2 p-l-15 p-r-15">
                        <div class="block2">
                            <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
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
                                <a href="{{route('product.detail',['name' => str_slug($product->name),'id' => $product->id])}}" class="block2-name dis-block s-text3 p-b-5">{{ $product->name }}
                                </a>

                                <span class="block2-price m-text6 p-r-5">
                                  <i class="fa fa-money"></i>  {{ number_format($product->price) }} {{ config('custom.vnd') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    <section class="blog bgwhite p-t-94 p-b-65">
        <div class="container">
            <div class="sec-title p-b-52">
                <h3 class="m-text5 t-center">
                    @lang('message.our_blog')
                </h3>
            </div>

            <div class="row">
                <div class="col-sm-10 col-md-4 p-b-30 m-l-r-auto">
                    <div class="block3">
                        <a href="blog-detail.html" class="block3-img dis-block hov-img-zoom">
                            <img src="images/blog-01.jpg" alt="IMG-BLOG">
                        </a>

                        <div class="block3-txt p-t-14">
                            <h4 class="p-b-7">
                                <a href="blog-detail.html" class="m-text11">
                                </a>
                            </h4>

                            <span class="s-text6"></span> <span class="s-text7"></span>
                            <span class="s-text6"></span> <span class="s-text7"></span>

                            <p class="s-text8 p-t-16">
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="shipping bgwhite p-t-62 p-b-46">
        <div class="flex-w p-l-15 p-r-15">
            <div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
                <h4 class="m-text12 t-center">
                    @lang('message.free_delivery')
                </h4>

                <a href="#" class="s-text11 t-center">
                    @lang('message.click_here')
                </a>
            </div>

            <div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 bo2 respon2">
                <h4 class="m-text12 t-center">
                    @lang('message.30_days')
                </h4>

                <span class="s-text11 t-center">
                    @lang('message.simply_return')
                </span>
            </div>

            <div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
                <h4 class="m-text12 t-center">
                    @lang('message.store_opening')
                </h4>

                <span class="s-text11 t-center">
                    @lang('message.shop_open')
                </span>
            </div>
        </div>
    </section>
@endsection
