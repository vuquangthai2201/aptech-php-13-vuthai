<?php

namespace App\Repositories;

use App\Models\OrderDetail;
use App\Repositories\EloquentRepository;

class OrderDetailRepository extends EloquentRepository
{
    public function getModel()
    {
        return OrderDetail::class;
    }

    public function delOrderDetail($order_id)
    {
        return $this->model->where('order_id', $order_id)->delete();
    }
}
