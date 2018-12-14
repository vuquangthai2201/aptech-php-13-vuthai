<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
    <div class="leftbar p-r-20 p-r-0-sm">
        {{ Form::open(['method' => 'GET', 'route' => 'product.filter', 'class' =>'filter-form']) }}
        <h4 class="m-text14 p-b-7 bo3">
            @lang('message.categories')
        </h4>
        <div class="col col-12">
            <div class="checkbox">
                {{ Form::checkbox('cat[]', config('custom.zero'),
                    !request()->input('cat') || in_array(config('custom.zero'), request()->input('cat')) ? true : false, ['id' => 'cat-all']) }}
                {{ Form::label('', trans('message.leftbar.all')) }}
            </div>

            @foreach ($categories as $category)
            <div class="checkbox">
                {{ Form::checkbox('cat[]', $category->id,
                    request()->input('cat') && in_array($category->id, request()->input('cat')) ? true : false, ['id' => 'cat-parent'.$category->id]) }}
                {{ Form::label('', $category->name) }}
            </div>
                @foreach ($category->children as $sub_category)
                <div class="checkbox">
                    <i class='fa fa-hand-o-right'></i>
                    {{ Form::checkbox('cat[]', $sub_category->id,
                        request()->input('cat') && in_array($sub_category->id, request()->input('cat')) ? true : false, ['id' => 'cat-'.$sub_category->id]) }}
                    {{ Form::label('', $sub_category->name) }}
                </div>
                @endforeach
            @endforeach
        </div>

        <h4 class="m-text14 p-b-7 bo3">
            @lang('message.product.strap_type')
        </h4>
        <div class="col col-12">
            <div class="checkbox">
                {{ Form::checkbox('strap[]', trans('message.leftbar.all'), !request()->input('strap')
                    || in_array(trans('message.leftbar.all'), request()->input('strap')) ? true : false, ['id' => 'strap-all']) }}
                {{ Form::label('', trans('message.leftbar.all')) }}
            </div>
            <div class="checkbox">
                {{ Form::checkbox('strap[]', trans('message.leftbar.leather_cord'), request()->input('strap')
                    && in_array(trans('message.leftbar.leather_cord'), request()->input('strap')) ? true : false, ['id' => 'strap-'.config('custom.min')]) }}
                {{ Form::label('', trans('message.leftbar.leather_cord')) }}
            </div>
            <div class="checkbox">
                {{ Form::checkbox('strap[]', trans('message.leftbar.stainless_steel'), request()->input('strap')
                    && in_array(trans('message.leftbar.stainless_steel'), request()->input('strap')) ? true : false, ['id' => 'strap-'.config('custom.two')]) }}
                {{ Form::label('', trans('message.leftbar.stainless_steel')) }}
            </div>
        </div>

        <h4 class="m-text14 p-b-7 bo3">
            @lang('message.product.energy')
        </h4>
        <div class="col col-12">
            <div class="checkbox">
                {{ Form::checkbox('energy[]', trans('message.leftbar.all'), !request()->input('energy')
                    || in_array(trans('message.leftbar.all'), request()->input('energy')) ? true : false, ['id' => 'energy-all']) }}
                {{ Form::label('', trans('message.leftbar.all')) }}
            </div>
            <div class="checkbox">
                {{ Form::checkbox('energy[]', trans('message.leftbar.mechanical_watch'), request()->input('energy')
                    && in_array(trans('message.leftbar.mechanical_watch'), request()->input('energy')) ? true : false, ['id' => 'energy-'.config('custom.min')]) }}
                {{ Form::label('', trans('message.leftbar.mechanical_watch')) }}
            </div>
            <div class="checkbox">
                {{ Form::checkbox('energy[]', trans('message.leftbar.electronic_watch'), request()->input('energy')
                    && in_array(trans('message.leftbar.electronic_watch'), request()->input('energy')) ? true : false, ['id' => 'energy-'.config('custom.two')]) }}
                {{ Form::label('', trans('message.leftbar.electronic_watch')) }}
            </div>
        </div>

        <h4 class="m-text14 p-b-7 bo3">
            @lang('message.product.skin_type')
        </h4>
        <div class="col col-12">
            <div class="checkbox">
                {{ Form::checkbox('skin[]', trans('message.leftbar.all'), !request()->input('skin')
                    || in_array(trans('message.leftbar.all'), request()->input('skin')) ? true : false, ['id' => 'skin-all']) }}
                {{ Form::label('', trans('message.leftbar.all')) }}
            </div>
            <div class="checkbox">
                {{ Form::checkbox('skin[]', trans('message.leftbar.solid_gold'), request()->input('skin')
                    && in_array(trans('message.leftbar.solid_gold'), request()->input('skin')) ? true : false, ['id' => 'skin-'.config('custom.min')]) }}
                {{ Form::label('', trans('message.leftbar.solid_gold')) }}
            </div>
            <div class="checkbox">
                {{ Form::checkbox('skin[]', trans('message.leftbar.plastic_cover'), request()->input('skin')
                    && in_array(trans('message.leftbar.plastic_cover'), request()->input('skin')) ? true : false, ['id' => 'skin-'.config('custom.two')]) }}
                {{ Form::label('', trans('message.leftbar.plastic_cover')) }}
            </div>
        </div>
        <div id="sort"></div>

        <div class="filter-price p-t-22 p-b-50 bo3">
            <div class="m-text15 p-b-17">
                @lang('message.product.price')
            </div>

            <div class="wra-filter-bar">
                <div id="filter-bar">
                    {{ Form::hidden('price_min', request()->input('price_min') ? request()->input('price_min') : config('custom.five'), ['id' => 'price_min']) }}
                    {{ Form::hidden('price_max', request()->input('price_max') ? request()->input('price_max') : config('custom.hundred'), ['id' => 'price_max']) }}
                </div>
            </div>

            <div class="flex-sb-m flex-w p-t-16">
                <div class="w-size11">
                    {{ Form::button('Filter', ['class' => 'flex-c-m size4 bg7 bo-rad-15 hov1 s-text14 trans-0-4', 'id' => 'filter_price']) }}
                </div>

                <div class="s-text3 p-t-10 p-b-10">
                    @lang('message.leftbar.range'): <span id="value-lower"></span>M {{ config('custom.vnd') }} - <span id="value-upper"></span>M {{ config('custom.vnd') }}
                </div>
            </div>
        </div>

        <div class="search-product pos-relative bo4 of-hidden">
            {{ Form::text('search', '', ['class' => 's-text7 size6 p-l-23 p-r-50', 'placeholder' => 'Search Products...']) }}
            {{ Form::button('<i class="fs-12 fa fa-search" aria-hidden="true"></i>', ['class' => 'flex-c-m size5 ab-r-m color2 color0-hov trans-0-4']) }}
        </div>
        {{ Form::close() }}
    </div>
</div>
