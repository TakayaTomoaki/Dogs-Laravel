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
        for ($i = 1; $i <= 200; $i++) {
            DB::table('follows')->insert([
          [
            'follower' => $i,
            'receiver' => $faker->numberBetween(1, 40)
          ],[
            'follower' => $i,
            'receiver' => $faker->numberBetween(41, 80)
          ],[
            'follower' => $i,
            'receiver' => $faker->numberBetween(81, 120)
          ],[
            'follower' => $i,
            'receiver' => $faker->numberBetween(121, 160)
          ],[
            'follower' => $i,
            'receiver' => $faker->numberBetween(161, 200)
          ]
        ]);
        }
    }
}
