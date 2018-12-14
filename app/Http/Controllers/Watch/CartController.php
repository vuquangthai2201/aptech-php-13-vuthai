<?php

namespace App\Http\Controllers\Watch;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Cookie;
use App\Repositories\ProductRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\OrderRepository;
use App\Repositories\OrderDetailRepository;
use App\Jobs\NotifyOrderUnconfirm;
use Pusher\Pusher;

class CartController extends Controller
{
    public function __construct(ProductRepository $productRepository, CustomerRepository $customerRepository,
        OrderRepository $orderRepository, OrderDetailRepository $orderDetailRepository)
    {
        $this->productRepository = $productRepository;
        $this->customerRepository = $customerRepository;
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
    }

    public function cookieCart()
    {
        $user_cart = 'shop_cart'.Auth::user()->id;
        if (Cookie::get($user_cart)){
            $cookie_data = Cookie::get($user_cart);
            $cart_data = json_decode($cookie_data, true);
        } else {
            $cart_data = array();
        }

        return $cart_data;
    }

    public function index(Request $request)
    {
        $products = $this->cookieCart();

        return view('watch.cart', compact('products'));
    }

    public function create(Request $request)
    {
        $count_cart = config('custom.zero');
        $user_cart = 'shop_cart'.Auth::user()->id;
        $product = $this->productRepository->findOrFail($request->id_product);
        $cart_data = $this->cookieCart();
        $item_id_list = array_column($cart_data, 'id_product');

        if(in_array($request->id_product, $item_id_list)) {
            foreach($cart_data as $keys => $values) {
                if($cart_data[$keys]["id_product"] == $request->id_product) {
                    $cart_data[$keys]["quantity"] = $cart_data[$keys]["quantity"] + config('custom.min');
                }
            }
        } else {
            $item_array = array(
                'id_product'   => $request->id_product,
                'name'   => $product->name,
                'price'  => $product->price,
                'quantity'  => config('custom.min'),
                'picture' => $product->picture,
            );
            $cart_data[] = $item_array;
        }
        foreach($cart_data as $keys => $values) {
            $count_cart += $cart_data[$keys]["quantity"];
        }
        echo $count_cart;
        $item_data = json_encode($cart_data);
        $cookie = cookie($user_cart, $item_data, config('custom.timeout_cookie'));
        $respone = new Response;
        return $respone->withCookie($cookie);
    }

    public function update(Request $request, $id)
    {
        $user_cart = 'shop_cart'.Auth::user()->id;
        $cart_data = $this->cookieCart();
        $item_id_list = array_column($cart_data, 'id_product');

        if(in_array($id, $item_id_list)) {
            foreach($cart_data as $keys => $values) {
                if($cart_data[$keys]["id_product"] == $id) {
                    $cart_data[$keys]["quantity"] = $request->number;
                }
            }
        } else {
            return redirect()->route('cart.index');
        }
        $item_data = json_encode($cart_data);
        $cookie = cookie($user_cart, $item_data, config('custom.timeout_cookie'));

        return redirect()->route('cart.index')->withCookie($cookie);
    }

    public function destroy(Request $request, $id)
    {
        $user_cart = 'shop_cart'.Auth::user()->id;
        $cart_data = $this->cookieCart();
        $item_id_list = array_column($cart_data, 'id_product');

        if(in_array($id, $item_id_list)) {
            foreach($cart_data as $keys => $values) {
                if($cart_data[$keys]["id_product"] == $id) {
                    unset($cart_data[$keys]);
                }
            }
        } else {
            return redirect()->route('cart.index');
        }
        $item_data = json_encode($cart_data);
        $cookie = cookie($user_cart, $item_data, config('custom.timeout_cookie'));

        return redirect()->route('cart.index')->withCookie($cookie);
    }

    public function inputInfo()
    {
        $count = $this->customerRepository->countCustomer();
        if ($count > config('custom.zero')){
            $customer = $this->customerRepository->firstCustomer();
        } else {
            $customer = NULL;
        }

        $products = $this->cookieCart();

        return view('watch.info', compact('count', 'customer', 'products'));
    }

    public function confirm(Request $request)
    {
        $count = $this->customerRepository->countCustomer();
        if ($count > config('custom.zero')){
            $customer = $this->customerRepository->firstCustomer();
            $customer->name = trim($request->name);
            $customer->phone = trim($request->phone);
            $customer->address = trim($request->address);
            $customer->save();
        } else {
            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'avatar' => '',
                'user_id' => Auth::user()->id,
            ];
            $this->customerRepository->create($data);
            $customer = $this->customerRepository->firstCustomer();
        }

        $products = $this->cookieCart();

        return view('watch.confirm', compact('count', 'customer', 'products'));
    }

    public function checkout(Request $request)
    {
        $user_cart = 'shop_cart'.Auth::user()->id;
        $customer = $this->customerRepository->firstCustomer();
        $cart_data = $this->cookieCart();

        $item_id_list = array_column($cart_data, 'id_product');
        $total = config('custom.zero');

        foreach($cart_data as $keys => $values) {
            $total += $cart_data[$keys]["quantity"] * $cart_data[$keys]["price"];
        }

        $data = [
            'name' => $customer->name,
            'phone' => $customer->phone,
            'address' => $customer->address,
            'payment_type' => 'Trả tiền khi nhận hàng',
            'total_price' => $total,
            'customer_id' => $customer->id,
        ];
        $this->orderRepository->create($data);
        $order = $this->orderRepository->descFirst($customer->id);
        foreach($cart_data as $keys => $values) {
            $dataDetail = [
                'order_id' => $order->id,
                'product_id' => $cart_data[$keys]["id_product"],
                'quantity' => $cart_data[$keys]["quantity"],
                'price' => $cart_data[$keys]["price"],
                'name_product'=> $cart_data[$keys]["name"],
            ];
            $product = $this->productRepository->findOrFail($cart_data[$keys]["id_product"]);
            $product->best_seller = $product->best_seller + $cart_data[$keys]["quantity"];
            $product->save();
            $this->orderDetailRepository->create($dataDetail);
        }
        $item_data = json_encode($cart_data);
        $cookie = cookie($user_cart, $item_data, config('custom.unset_cookie'));

        $job = new NotifyOrderUnconfirm($order);
        dispatch($job)->delay(config('custom.min'));

        $getOrder = $this->orderRepository->getOrderUnconfirm();
        $countOrder = $this->orderRepository->countOrderUnconfirmCustomer($order->customer->id);
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $getData = [
            'count' => $countOrder,
            'id' => Auth::user()->id,
        ];
        $pusher->trigger('notify-unconfirm', 'notify-admin', $getOrder);
        $pusher->trigger('notify-confirmed', 'notify-user', $getData);

        return redirect()->route('index')->withCookie($cookie);
    }

    public function changeCart(Request $request)
    {
        $user_cart = 'shop_cart'.Auth::user()->id;
        $total = config('custom.zero');
        if (Cookie::get($user_cart)){
            $cookie_data = Cookie::get($user_cart);
            $cart_data = json_decode($cookie_data, true);

            return view('watch.load_cart', compact($cart_data));
        }
    }
}
