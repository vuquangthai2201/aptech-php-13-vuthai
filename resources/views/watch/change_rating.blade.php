<span class="stars" data-rating="{{ $product->rating }}" data-num-stars="{{ config('custom.five') }}" >
    @php
        $i = config('custom.min');
        $rating = $product->rating;
    @endphp
    @for ($i = config('custom.zero'); $i < config('custom.five'); $i++ )
        @if ($i < floor($rating))
            <i class="fa fa-star"></i>
        @else
            @php
                $ten = $rating * config('custom.ten');
            @endphp
            @if ($ten % config('custom.ten') != config('custom.zero'))
                <i class="fa fa-star-half-empty"></i>
                @php
                    $rating = round($rating);
                    continue;
                @endphp
            @endif
            @if (round($rating) < config('custom.five'))
                <i class="fa fa-star-o"></i>
            @endif
        @endif
    @endfor
</span>
<span class="small">({{ $product->rating }})</span>
<span class="m-l-20">@lang('message.review'):  {{ count($product->ratings) }}</span>
