<?php

use Faker\Generator as Faker;

$factory->define(App\ProductSku::class, function (Faker $faker) {
    $colors = $faker->randomElement([
        'Red', 'Yellow', 'Green', 'Blue', 'Black', 'White'
    ]);
    $color = $colors;
    return [
        'title' => $color,
        'description' =>  $color,
        'stock_number' => '',
        'stock' => $faker->numberBetween(1, 100),
        'product_id' => '',
        'created_at' => date('Y-m-d h:m:s',time())
    ];
});
