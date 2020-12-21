<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Backend\Shop\Shop;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Shop::class, function (Faker $faker) {
    return [
        'phone' => $faker->unique()->phoneNumber,
        'password' => bcrypt('123456789'), // password
    ];
});
