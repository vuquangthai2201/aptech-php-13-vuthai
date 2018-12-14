<?php

namespace App\Http\Controllers\Watch;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Cookie;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->paginate(config('custom.paginate'));
        return view('watch.index', compact('products'));
    }

    public function detail(Request $request, $name, $id)
    {
        $product = $this->productRepository->findOrFail($id);

        if (Auth::check()){
            $recent = 'recent'.Auth::user()->id;
        } else {
            $recent = 'recent';
        }
        if (Cookie::get($recent)){
            $cookie_data = Cookie::get($recent);
            $recent_data = json_decode($cookie_data, true);
        } else {
            $recent_data = array();
        }

        $item_id_list = array_column($recent_data, 'id');

        if(in_array($product->id, $item_id_list)) {
            foreach($recent_data as $keys => $values) {
                if($recent_data[$keys]["id"] == $product->id) {
                    unset($recent_data[$keys]);
                }
            }
        }

        $item_array = array(
            'id'   => $product->id,
            'name'   => $product->name,
            'picture' => $product->picture,
        );
        $recent_data[] = $item_array;

        if (count($recent_data) > config('custom.paginate')){
            $recent_data = array_slice($recent_data, config('custom.min'));
        }
        $item_data = json_encode($recent_data);
        $cookie = cookie($recent, $item_data, config('custom.timeout_cookie'));

        return response()->view('watch.product_detail', compact('product', 'recent_data'))->withCookie($cookie);
    }

    public function filter(Request $request)
    {
        $products = $this->productRepository->filter($request->cat, $request->strap, $request->skin, $request->energy,
            $request->price_min, $request->price_max, $request->search, $request->sort);

        return view('watch.filter', compact('products'));
    }
}
