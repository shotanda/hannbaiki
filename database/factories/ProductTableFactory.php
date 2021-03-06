<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'product_name'=>$faker ->word,
        'price'=>$faker ->randomDigitNotNull,
        'stock'=>$faker->randomDigit,
        'company_name'=>$faker->company,
    ];
});