<?php declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 300),
        'share_id' => $faker->numberBetween(1, 1000),
        'comment' => $faker->realText(50),
    ];
});
