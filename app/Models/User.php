<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Suggest;
use App\Models\Blog;
use App\Models\Customer;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'provide_id',
        'provide',
        'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function customers()
    {
        return $this->hasOne(Customer::class);
    }
}
