<div class="col-md-12">
    @php
        $i = config('custom.zero');
    @endphp
    <span class="stars" data-rating="{{ $review->point }}" data-num-stars="{{ config('custom.five') }}" >
        @for ($i == config('custom.zero'); $i < config('custom.five'); $i++ )
            @if ($i < round($review->point))
                <i class="fa fa-star"></i>
            @else
                <i class="fa fa-star-o"></i>
            @endif
        @endfor
    </span>
    <span class="m-l-20">{{ $review->user->name }}</span>
    <span class="m-l-20">{{ $review->created_at }}</span>
    <p>{!! $review->content !!}</p>
</div>
