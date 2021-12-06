<?php

use App\Models\Follow;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class FollowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 1; $i <= 300; $i++) {
            DB::table('follows')->insert([
        [
          'follower' => $i,
          'receiver' => $faker->numberBetween(1, 30)
        ], [
          'follower' => $i,
          'receiver' => $faker->numberBetween(31, 60)
        ], [
          'follower' => $i,
          'receiver' => $faker->numberBetween(61, 90)
        ], [
          'follower' => $i,
          'receiver' => $faker->numberBetween(91, 120)
        ], [
          'follower' => $i,
          'receiver' => $faker->numberBetween(121, 150)
        ], [
          'follower' => $i,
          'receiver' => $faker->numberBetween(151, 180)
        ], [
          'follower' => $i,
          'receiver' => $faker->numberBetween(181, 210)
        ], [
          'follower' => $i,
          'receiver' => $faker->numberBetween(211, 240)
        ], [
          'follower' => $i,
          'receiver' => $faker->numberBetween(241, 270)
        ], [
          'follower' => $i,
          'receiver' => $faker->numberBetween(271, 300)
        ]
      ]);
        }
    }
}
