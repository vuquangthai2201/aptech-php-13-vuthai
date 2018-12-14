<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\EloquentRepository;

class UserRepository extends EloquentRepository
{
    public function getModel()
    {
        return User::class;
    }

    public function create(array $data = [])
    {
        return $this->model->create($data);
    }

    public function countAdmin()
    {
        return $this->model->where('role', config('custom.admin'))->count();
    }

    public function countCustomer()
    {
        return $this->model->where('role', config('custom.customer'))->count();
    }

    public function checkUserExist($email)
    {
        return $this->model->where('email', $email)
                           ->where('provide_id', null)
                           ->first();
    }

    public function getUserExist($provide_id)
    {
        return $this->model->where('provide_id', $provide_id)->first();
    }
}
