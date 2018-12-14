<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Repositories\EloquentRepository;

class CustomerRepository extends EloquentRepository
{
    public function getModel()
    {
        return Customer::class;
    }

    public function countCustomer()
    {
        return $this->model->where('user_id', '=', Auth::user()->id)->count();
    }

    public function firstCustomer()
    {
        return $this->model->where('user_id', '=', Auth::user()->id)->first();
    }
}
