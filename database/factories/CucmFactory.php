<?php

use Faker\Generator as Faker;

$factory->define(App\Cucm::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'ip' => $faker->unique()->ipv4,
        'user' => $faker->firstName,
        'password' => 'supersecretpassword',
        'version' => '10.5',
        'verify_peer' => false,
    ];
});
