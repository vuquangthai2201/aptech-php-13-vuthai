<?php

namespace App\Repositories;

use App\Models\Rating;
use App\Repositories\EloquentRepository;

class RatingRepository extends EloquentRepository
{
    public function getModel()
    {
        return Rating::class;
    }

    public function avgProduct($product_id)
    {
        return $this->model->groupBy('product_id')->having('product_id', '=', $product_id)->avg('point');
    }

    public function userProductRating($user_id, $product_id)
    {
        return $this->model->where('user_id', '=', $user_id)->where('product_id', '=', $product_id)->orderBy('id', 'DESC')->first();
    }
}
