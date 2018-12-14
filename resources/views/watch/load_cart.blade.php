@php
    $total = config('custom.zero');
@endphp
<ul class="header-cart-wrapitem">
@foreach ($cart_data as $keys => $values)
    <li class="header-cart-item">
        <div class="header-cart-item-img">
            {{ Html::image(asset("images/products/".$cart_data[$keys]['picture'])) }}
        </div>

        <div class="header-cart-item-txt">
            <a href="#" class="header-cart-item-name">
                {{ $cart_data[$keys]['name'] }}
            </a>
            <span class="header-cart-item-info">
                {{ $cart_data[$keys]['quantity'] }}  x  {{ number_format($cart_data[$keys]['price']) }} {{ config('custom.vnd') }}
            </span>
        </div>
    </li>
    @php
        $total += $cart_data[$keys]['price'] * $cart_data[$keys]['quantity'];
    @endphp
@endforeach
</ul>
<div class="header-cart-total">
    @lang('message.product.total'): {{ number_format($total) }} {{ config('custom.vnd') }}
</div>
