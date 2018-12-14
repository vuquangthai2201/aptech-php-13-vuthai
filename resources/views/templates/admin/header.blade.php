<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> @lang('message.admin.admin')</title>
    <link href='/resources/assets/templates/cellphone/images/admin.png' rel='icon' type='image/x-icon'/>
    {{ Html::style(asset('css/admin.css')) }}
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ Route('index') }}">
                    {{ Html::image(asset('images/icons/logo.jpg')) }}
                </a>
            </div>
            <style type="text/css">
            </style>
            <div id="reload">
                <ul class="nav navbar-right top-nav">
                    <li class="dropdown dropdown-notification">
                        <a href="javascript:void" class="dropdown-toggle" data-toggle="dropdown" >
                            <span class="label label-pill label-danger count" id="number">{{ count($orderUnconfirm) }}</span>
                            <i class="fa fa-bell"></i> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu message-dropdown">
                            <li class="message-footer">
                                @foreach($orderUnconfirm as $order)
                                    <a href="{{ route('order.show', $order->id) }}" target="_blank">
                                        {{ Html::image("https://api.adorable.io/avatars/10/$order->id.png") }}
                                        @lang('message.order_number'): {{ $order->id }} @lang('message.unconfirm')
                                    </a>
                                @endforeach
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i>    <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href=""><i class="fa fa-fw fa-power-off"></i> @lang('message.logout')</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                @include('templates.admin.leftbar')
            </div>
        </nav>
