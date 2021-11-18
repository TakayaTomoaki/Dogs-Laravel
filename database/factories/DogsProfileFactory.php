<?php declare(strict_types=1);

/** @var Factory $factory */

use App\Models\User;
use App\Models\Dogs_profile;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Dogs_profile::class, function (Faker $faker) {
    $breed = 'D' . $faker->numberBetween($min = 1, $max = 173);

    $user_id = function () {
        return factory(User::class)->create()->id;
    };
    $location = function (array $post) {
        $pref = User::find($post['user_id'])->location;
        return config('prefecture.prefs')[$pref];
    };

    return [
        'user_id' => $user_id,
        'dog_name' => $faker->firstKanaName,
        'location' => $location,
        'dog_birthday' => $faker->dateTimeBetween('-20years', 'now')->format('Y-m-d'),
        'dog_gender' => $faker->randomElement(['0', '1']),
        'dog_weight' => $faker->numberBetween($min = 2, $max = 50),
        'dog_father' => $breed,
        'dog_daddy' => config('dogbreed.breeds')[$breed],
        'dog_mother' => $breed,
        'dog_mommy' => config('dogbreed.breeds')[$breed],
        'dog_introduction' => $faker->realText(100)
    ];
});
