<?php

use App\Models as Models;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '123456', // secret
        'remember_token' => str_random(10),
        'role' => $faker->randomElement([
            'admin',
            'customer',
        ]),
        'active' => 0,
    ];
});

$factory->define(Models\Customer::class, function (Faker $faker) {
    return [
        'name' => Models\User::all()->where('role', '=', 'customer')->random()->name,
        'user_id' => Models\User::all()->where('role', '=', 'customer')->random()->id,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'avatar' => $faker->image(),
    ];
});

$factory->define(Models\Blog::class, function (Faker $faker) {
    return [
        'user_id' => Models\User::all()->where('role', '=', 'admin')->random()->id,
        'title' => str_random(10),
        'content' => $faker->text,
        'picture' => $faker->image(),
    ];
});

$factory->define(Models\Category::class, function (Faker $faker) {
    return [
        'name' => str_random(10),
        'parent_id' => 0,
    ];
});

$factory->define(Models\Product::class, function (Faker $faker) {
    return [
        'category_id' => Models\Category::all()->random()->id,
        'name' => str_random(10),
        'price' => $faker->randomFloat(1, 5),
        'preview' => $faker->text,
        'description' => $faker->text,
        'picture' => $faker->image(),
        'rating' => $faker->randomNumber(1),
        'best_seller' => 0,
        'energy' => $faker->randomElement([
            'Đồng hồ cơ',
            'Đồng hồ điện tử',
        ]),
        'strap_type' => $faker->randomElement([
            'Dây da',
            'Thép không gỉ',
            'Mạ vàng',
            'Cao su',
        ]),
        'skin_type' => $faker->randomElement([
            'Vỏ nhựa',
            'Vàng nguyên khối',
            'Hợp kim thép'
        ]),
    ];
});

$factory->define(Models\Rating::class, function (Faker $faker) {
    return [
        'product_id' => Models\Product::all()->random()->id,
        'user_id' => Models\User::all()->where('role', '=', 'customer')->random()->id,
        'point' => $faker->randomNumber(1),
        'content' => $faker->text,
    ];
});

$factory->define(Models\Suggest::class, function (Faker $faker) {
    return [
        'product_id' => Models\Product::all()->random()->id,
        'user_id' => Models\User::all()->where('role', '=', 'customer')->random()->id,
        'status' => 0,
        'content' => $faker->text,
    ];
});

$factory->define(Models\Comment::class, function (Faker $faker) {
    return [
        'product_id' => Models\Product::all()->random()->id,
        'user_id' => Models\User::all()->where('role', '=', 'customer')->random()->id,
        'parent_id' => 0,
        'content' => $faker->text,
    ];
});

$factory->define(Models\Order::class, function (Faker $faker) {
    return [
        'name' => Models\Customer::all()->random()->name,
        'address' => Models\Customer::all()->random()->address,
        'phone' => Models\Customer::all()->random()->phone,
        'customer_id' => Models\Customer::all()->random()->id,
        'payment_type' => 'Trả tiền khi nhận hàng',
        'total_price' => $faker->randomFloat(1, 10),
        'status' => 0,
    ];
});

$factory->define(Models\OrderDetail::class, function (Faker $faker) {
    return [
        'order_id' => Models\Order::all()->random()->id,
        'quantity' => $faker->randomNumber(1),
        'name_product' => str_random(15),
        'product_id' => Models\Product::all()->random()->id,
        'price' => $faker->randomFloat(1, 10),
    ];
});
