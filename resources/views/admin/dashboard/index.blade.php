@extends('templates.admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid m-b-50">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <i class="fa fa-home"></i> @lang('message.dashboard')
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @include('errors.error')
            </div>
        </div>
        <ul class="nav nav-tabs">
            <li class="chart-click active" id="months"><a href="#">@lang('message.chart.around_12mons')</a></li>
            <li class="chart-click" id="years"><a href="#">@lang('message.chart.around_4years')</a></li>
        </ul>
        <div class="row">
            <div class="months col-lg-12">
                {!! $chart->html() !!}
            </div>
        </div>
        <div class="row">
            <div class="d-none years col-md-12">
                {!! $year_chart->html() !!}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                {!! $pie_product_chart->html() !!}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                {!! $pie_chart->html() !!}
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12"><br></div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user-o fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $countUser }}</div>
                                <div>@lang('message.admin.user')</div>
                            </div>
                        </div>
                    </div>
                    <a href="">
                        <div class="panel-footer">
                            <span class="pull-left">@lang('message.admin.view_detail')</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-bars fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $countCategory }}</div>
                                <div>@lang('message.admin.category')</div>
                            </div>
                        </div>
                    </div>
                    <a href="">
                        <div class="panel-footer">
                            <span class="pull-left">@lang('message.admin.view_detail')</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-book fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $countProduct }}</div>
                                <div>@lang('message.admin.product')</div>
                            </div>
                        </div>
                    </div>
                    <a href="">
                        <div class="panel-footer">
                            <span class="pull-left">@lang('message.admin.view_detail')</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $countOrder }}</div>
                                <div>@lang('message.admin.order')</div>
                            </div>
                        </div>
                    </div>
                    <a href="">
                        <div class="panel-footer">
                            <span class="pull-left">@lang('message.admin.view_detail')</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Charts::scripts() !!}
{!! $chart->script() !!}
{!! $year_chart->script() !!}
{!! $pie_chart->script() !!}
{!! $pie_product_chart->script() !!}
@endsection
