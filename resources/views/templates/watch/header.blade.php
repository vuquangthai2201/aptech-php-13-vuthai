<!DOCTYPE html>
<html lang="en">
<head>
    <title>@lang('message.home')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/icons/logo.jpg') }}"/>
    {{ Html::style(asset('css/all.css')) }}
    {{ Html::style(asset('css/app.css')) }}
</head>
<body class="animsition">

    <header class="header1">
        <div class="container-menu-header">
            <div class="topbar">
                <div class="topbar-social">
                    <a href="#" class="topbar-social-item fa fa-facebook"></a>
                    <a href="#" class="topbar-social-item fa fa-instagram"></a>
                    <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
                    <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
                    <a href="#" class="topbar-social-item fa fa-youtube-play"></a>
                </div>

                <span class="topbar-child1">
                    @lang('message.free_ship')
                </span>

                <div class="topbar-child2">
                </div>
            </div>

            <div class="wrap_header">
                <a href="{{ Route('index') }}" class="logo">
                    {{ Html::image(asset('images/icons/logo.jpg')) }}
                </a>
                <div class="wrap_menu">
                    <nav class="menu">
                        <ul class="main_menu">
                            @foreach ($categories as $category)
                            <li>
                                <a href="{{ Route('product.filter', ['cat[]' => $category->id]) }}">{{ $category->name }}</a>
                                @if (count($category->children) > config('custom.zero'))
                                <ul class="sub_menu">
                                    @foreach ($category->children as $sub_category)
                                    <li>
                                        <a href="{{ Route('product.filter', ['cat[]' => $sub_category->id]) }}">{{ $sub_category->name }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endforeach

                            <li>
                                <a href="blog.html">@lang('message.blog')</a>
                            </li>

                            <li>
                                <a href="contact.html">@lang('message.contact')</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="header-icons">
                    <ul class="header-wrapicon1 dis-block main_menu">
                        @if (Auth::check())
                            <li>
                                <i class="fa fa-user fa-2x fa-fw"></i>{{ Auth::user()->name }}
                                <span class="countUser-{{ Auth::user()->id }}">
                                    @if (Auth::user()->role == config('custom.customer'))
                                        @if ($countOrderUnconfirmUser > config('custom.zero'))
                                            ({{ $countOrderUnconfirmUser }})
                                        @endif
                                    @endif
                                </span>
                                <ul class="sub_menu_user">
                                    <li><a href="{{ Route('profile.index') }}">@lang('message.profile')</a></li>
                                    @if (Auth::user()->role == config('custom.customer'))
                                        <li>
                                            <a href="{{ Route('profile.order') }}">@lang('message.your_order')</a>
                                        </li>
                                    @else
                                        <li><a href="{{ Route('dashboard.index') }}">@lang('message.admin.admin')</a></li>
                                    @endif
                                    <li>
                                        <a id="click-logout" href="javascript:;">@lang('message.logout')</a>
                                        {{ Form::open(['route' => 'logout', 'method' => 'post', 'id' => 'logout-form',]) }}
                                        {{ Form::close() }}
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li>
                                <i class="fa fa-user-secret fa-2x fa-fw"></i>@lang('message.account')
                                <ul class="sub_menu_user">
                                    <li><a href="{{ Route('login') }}">@lang('message.login')</a></li>
                                    <li><a href="{{ Route('register') }}">@lang('message.register')</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                    <span class="linedivide1"></span>

                    <div class="header-wrapicon2">
                        <div class="header-icon1 js-show-header-dropdown">
                            <i class="fa fa-opencart fa-2x fa-fw"></i>
                        </div>
                        <span class="header-icons-noti">{{ Auth::check() ? $count_cart : config('custom.zero') }}</span>

                        @if (Auth::check() )
                        <div class="header-cart header-dropdown">
                            <div class="change-cart">
                                <ul class="header-cart-wrapitem">
                                @php
                                    $total = config('custom.zero');
                                @endphp
                                @foreach ($cart_data as $keys => $values)
                                    <li class="header-cart-item">
                                        <div class="header-cart-item-img">
                                            {{ Html::image(asset("images/products/".$values['picture'])) }}
                                        </div>

                                        <div class="header-cart-item-txt">
                                            <a href="#" class="header-cart-item-name">
                                                {{ $values['name'] }}
                                            </a>
                                            <span class="header-cart-item-info">
                                                {{ $values['quantity'] }} x {{ number_format($values['price']) }} {{ config('custom.vnd') }}
                                            </span>
                                        </div>
                                    </li>
                                    @php
                                        $total +=  $values['quantity']* $values['price'];
                                    @endphp
                                @endforeach
                                </ul>

                                <div class="header-cart-total">
                                    @lang('message.product.total'): {{ number_format($total) }} {{ config('custom.vnd') }}
                                </div>
                            </div>

                            <div class="header-cart-buttons">
                                <div class="header-cart-wrapbtn">
                                    <a href="{{ Route('cart.index') }}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        @lang('message.view_cart')
                                    </a>
                                </div>

                                <div class="header-cart-wrapbtn">
                                    <a href="{{ Route('cart.info') }}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        @lang('message.check_out')
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>
