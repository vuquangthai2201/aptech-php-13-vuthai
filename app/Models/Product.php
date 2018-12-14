<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Suggest;
use App\Models\OrderDetail;

class Product extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function suggests()
    {
        return $this->hasMany(Suggest::class);
    }

    public function orderdetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
