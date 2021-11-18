<?php declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Share;
use Faker\Generator as Faker;

$factory->define(Share::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 200),
        'body' => $faker->realText(100),
    ];
});
