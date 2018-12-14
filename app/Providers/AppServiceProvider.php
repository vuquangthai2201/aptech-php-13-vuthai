<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Cookie;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view){
            if (Auth::check()) {
                $count_cart = config('custom.zero');
                $user_cart = 'shop_cart'.Auth::user()->id;
                if (Cookie::get($user_cart)){
                    $cookie_data = Cookie::get($user_cart);
                    $cart_data = json_decode($cookie_data, true);

                    foreach ($cart_data as $keys => $values) {
                        $count_cart += $cart_data[$keys]['quantity'];
                    }
                } else {
                    $cart_data = array();
                }
                $view->with('count_cart', $count_cart)->with('cart_data', $cart_data);
            }
        });

        View::share('categories', Category::where('parent_id', '=', config('custom.zero'))->get());
        View::share('trend_products', Product::orderBy('best_seller', 'DESC')->limit(config('custom.paginate'))->get());
        View::share('new_products', Product::orderBy('id', 'DESC')->limit(config('custom.paginate'))->get());
        View::composer('*', function($view) {
            if (Auth::check()){
                if (Auth::user()->customers != null) {
                    $countOrderUnconfirmUser = Order::where('customer_id', Auth::user()->customers->id)->where('status', config('custom.zero'))->count();
                } else {
                    $countOrderUnconfirmUser = config('custom.zero');
                }
                $view->with('countOrderUnconfirmUser', $countOrderUnconfirmUser);
            }
        });
        View::share('orderUnconfirm', Order::where('status', config('custom.zero'))->get());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
