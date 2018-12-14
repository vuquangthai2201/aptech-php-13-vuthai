<?php

namespace App\Http\Controllers\Watch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ProductRepository;
use App\Repositories\RatingRepository;

class RatingController extends Controller
{
    public function __construct(ProductRepository $productRepository, RatingRepository $ratingRepository)
    {
        $this->productRepository = $productRepository;
        $this->ratingRepository = $ratingRepository;
    }

    public function index(Request $request)
    {
        $data = [
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'content' => $request->content,
            'point' => $request->point,
        ];
        $this->ratingRepository->create($data);

        $product = $this->productRepository->findOrFail($request->product_id);
        $avg = $this->ratingRepository->avgProduct($request->product_id);
        $product->rating = $avg;
        $product->save();
        $review = $this->ratingRepository->userProductRating(Auth::user()->id, $request->product_id);

        return view('watch.change_review', compact('review'));
    }

    public function changeRating(Request $request)
    {
        $product = $this->productRepository->findOrFail($request->product_id);

        return view('watch.change_rating', compact('product'));
    }
}
