<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;

class Customer extends Model
{
    public function orderdetails()
    {
        return $this->hasManyThrough(OrderDetail::class, Order::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class)->latest();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
