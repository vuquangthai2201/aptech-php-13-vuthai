<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;

class OrderRepository extends EloquentRepository
{
    public function getModel()
    {
        return Order::class;
    }

    public function descFirst($customer_id)
    {
        return $this->model->where('customer_id', '=', $customer_id)->orderBy('id' ,'DESC')->first();
    }

    public function getTotalPriceMonth($month)
    {
        return $this->model->whereMonth('created_at', Carbon::now()->subMonth($month))
                           ->whereYear('created_at', Carbon::now()->subMonth($month))
                           ->where('status', config('custom.two'))
                           ->sum('total_price');
    }

    public function latest()
    {
        return $this->model->latest()->paginate(config('custom.ten'));
    }

    public function getOrderUnconfirm()
    {
        return $this->model->where('status', config('custom.zero'))->get();
    }

    public function countOrderUnconfirmCustomer($customer_id)
    {
        return $this->model->where('status', config('custom.zero'))
                           ->where('customer_id', $customer_id)
                           ->count();
    }

    public function countAllOrderMonth()
    {
        return $this->model->whereMonth('created_at', Carbon::now())
                           ->whereYear('created_at', Carbon::now())
                           ->count();
    }

    public function countUnconfirmOrderMonth()
    {
        return $this->model->whereMonth('created_at', Carbon::now())
                           ->whereYear('created_at', Carbon::now())
                           ->where('status', config('custom.zero'))
                           ->count();
    }

    public function countDeliveringOrderMonth()
    {
        return $this->model->whereMonth('created_at', Carbon::now())
                           ->whereYear('created_at', Carbon::now())
                           ->where('status', config('custom.min'))
                           ->count();
    }

    public function getRevenueOrderMonth()
    {
        return $this->model->whereMonth('created_at', Carbon::now())
                           ->whereYear('created_at', Carbon::now())
                           ->where('status', config('custom.two'))
                           ->sum('total_price');
    }

    public function getTotalPriceYear($year)
    {
        return $this->model->whereYear('created_at', Carbon::now()->subYear($year))
                           ->where('status', config('custom.two'))
                           ->sum('total_price');
    }
}
