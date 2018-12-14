<ul class="nav navbar-nav side-nav">
    <li class="">
        <a href="{{ Route('dashboard.index') }}"><i class="fa fa-fw fa-home"></i> @lang('message.dashboard')</a>
    </li>
    <li class="">
        <a href="{{ Route('user.index') }}"><i class="fa fa-fw fa-user"></i> @lang('message.admin.user')</a>
    </li>
    <li class="">
        <a href="{{ Route('category.index') }}"><i class="fa fa-fw fa-bars"></i> @lang('message.admin.category')</a>
    </li>
    <li class="">
        <a href="{{ Route('product.index') }}"><i class="fa fa-fw fa-book"></i> @lang('message.admin.product')</a>
    </li>
    <li class="">
        <a href="{{ Route('order.index') }}"><i class="fa fa-fw fa-shopping-cart"></i> @lang('message.admin.order')</a>
    </li>
</ul>
