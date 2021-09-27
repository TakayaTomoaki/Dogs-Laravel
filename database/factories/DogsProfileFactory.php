<?php

/** @var Factory $factory */

use App\Models\User;
use App\Models\Dogs_profile;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Dogs_profile::class, function (Faker $faker) {
    $breed = 'D'.$faker->numberBetween($min=1, $max=173);

    return [
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'dog_name' => $faker->firstKanaName,
        'dog_birthday' => $faker->dateTimeBetween('-20years', 'now')->format('Y-m-d'),
        'dog_gender' => $faker->randomElement(['0','1']),
        'dog_weight' => $faker->numberBetween($min=2, $max=50),
        'dog_father' => $breed,
        'dog_mother' => $breed,
        'dog_introduction' => $faker->realText(50)
    ];
});
