<?php declare(strict_types=1);

/** @var Factory $factory */

use App\Models\Nice;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Nice::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 200),
        'share_id' => $faker->numberBetween(1, 500),
    ];
});
