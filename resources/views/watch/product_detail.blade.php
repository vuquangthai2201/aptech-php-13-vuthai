@extends('templates.watch.master')
@section('content')
    <div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
    </div>

    <div class="container bgwhite p-t-35 p-b-80">
        <div class="flex-w flex-sb">
            <div class="w-size13 p-t-30 respon5">
                <div class="wrap-slick3 flex-sb flex-w">
                    <div class="wrap-slick3-dots"></div>

                    <div class="slick3">
                        <div class="item-slick3" data-thumb="{{ asset("images/products/$product->picture") }}">
                            <div class="wrap-pic-w">
                                {{ Html::image(asset("images/products/$product->picture")) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-size14 p-t-30 respon5">
                <h4 class="product-detail-name m-text16 p-b-13">
                    {{ $product->name }}
                </h4>

                <span class="m-text17">
                    <i class="fa fa-money"> {{ number_format($product->price) }} {{ config('custom.vnd') }} </i>
                </span>

                <p class="s-text8 p-t-10">
                    {!! $product->preview !!}
                </p>

                <div class="p-t-33 p-b-60">
                    <div class="flex-r-m flex-w p-t-10">
                        <div class="w-size16 flex-m flex-w">
                            <div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
                                {{ Form::button(trans('message.add_to_cart'), ['class' => 'flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4', 'onclick' => Auth::check() ? 'addcart('.$product->id.')' : '']) }}
                                {{ Form::hidden('name', route('cart.create'), array('id' => $product->id)) }}
                                {{ Form::hidden('change', route('cart.change'), array('id' => 'changecart-'.$product->id)) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        @lang('message.description')
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>

                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                            {!! $product->description !!}
                        </p>
                    </div>
                </div>

                <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        @lang('message.add_information')
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>

                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">

                        </p>
                    </div>
                </div>

                <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        @lang('message.review')
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>

                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <div class="placeholder">
                            <span class="stars" data-rating="{{ $product->rating }}" data-num-stars="5" ></span>
                            <span class="small">({{ $product->rating }})</span>
                            <span class="m-l-20">@lang('message.review'):  {{ count($product->ratings) }}</span>
                        </div>
                        @if (Auth::check())
                            @if (Auth::user()->role == 'customer' && $product->ratings->where('user_id', '=', Auth::user()->id)->count() < config('custom.min'))
                            <section class='row rating-widget'>
                                <div class='col-md-4 rating-stars text-center'>
                                    <ul id='stars'>
                                        <li class="selected" data-value='0'></li>
                                        <li class='star' title='Poor' data-value='1'>
                                            <i class='fa fa-star'></i>
                                        </li>
                                        <li class='star' title='Fair' data-value='2'>
                                            <i class='fa fa-star'></i>
                                        </li>
                                        <li class='star' title='Good' data-value='3'>
                                            <i class='fa fa-star'></i>
                                        </li>
                                        <li class='star' title='Excellent' data-value='4'>
                                            <i class='fa fa-star'></i>
                                        </li>
                                        <li class='star' title='WOW!!!' data-value='5'>
                                            <i class='fa fa-star'></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class='col-md-8 success-box'>
                                    <div class='clearfix'></div>
                                    <div class='text-message'></div>
                                    <div class='clearfix'></div>
                                </div>
                                <div class="col-md-12">
                                    {{ Form::open(['route' => 'rating.index', 'method' => 'get', 'id' => 'rating-form']) }}
                                        {!! Form::textarea('rating-content', '', ['class' => 'dis-block s-text7 size22 bo4 p-1 m-b-5',
                                        'rows' => config('custom.two'), 'cols' => config('custom.cols'), 'required', 'id' => 'content-form-rating']) !!}
                                        {{ Form::hidden('rating-name', route('rating.index'), ['class' => 'rating-name']) }}
                                        {{ Form::hidden('change-rating', route('rating.changerating'), ['class' => 'route-change-rating']) }}
                                        {{ Form::hidden('product-id', $product->id, ['class' => 'product-id']) }}
                                        {{ Form::hidden('user-id', Auth::user()->id, ['class' => 'user-id']) }}
                                        {{ Form::submit(trans('message.confirm'), ['class' => 'col-md-4 flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4', 'id' => 'submit-rating']) }}
                                    {{ Form::close() }}
                                </div>
                            </section>
                            @endif
                        @endif
                        <section class="content-rating row m-t-10">
                            <div class="ajax-content"></div>
                            @foreach($product->ratings as $rating)
                            <div class="col-md-12">
                                <span class="stars" data-rating="{{ $rating->point }}" data-num-stars="5" ></span>
                                <span class="m-l-20">{{ $rating->user->name }}</span>
                                <span class="m-l-20">{{ $rating->created_at }}</span>
                                <p>{!! $rating->content !!}</p>
                            </div>
                            @endforeach
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($recent_data != null)
    <section class="relateproduct bgwhite p-t-45 p-b-138">
        <div class="container">
            <div class="sec-title p-b-60">
                <h3 class="m-text5 t-center">
                    @lang('message.recently_viewed_product')
                </h3>
            </div>

            <div class="wrap-slick2">
                <div class="slick2">
                    @foreach ($recent_data as $keys => $value)
                    <div class="item-slick2 p-l-15 p-r-15">
                        <div class="block2">
                            <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                {{ Html::image(asset("images/products/".$value['picture'])) }}

                                <div class="block2-overlay trans-0-4">
                                    <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                        <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                        <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="block2-txt p-t-20">
                                <a target="_blank" href="{{route('product.detail',['name' => str_slug($value['name']),
                                    'id' => $value['id']])}}" class="block2-name dis-block s-text3 p-b-5">{{ $value['name'] }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection
