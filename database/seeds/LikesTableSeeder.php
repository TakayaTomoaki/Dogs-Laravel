<?php

use App\Models\Like;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 1; $i <= 300; $i++) {
            DB::table('likes')->insert([
          [
            'user_id' => $i,
            'comment_id' => $faker->numberBetween(1, 100)
          ],[
            'user_id' => $i,
            'comment_id' => $faker->numberBetween(101, 200)
          ],[
            'user_id' => $i,
            'comment_id' => $faker->numberBetween(201, 300)
          ],[
            'user_id' => $i,
            'comment_id' => $faker->numberBetween(301, 400)
          ],[
            'user_id' => $i,
            'comment_id' => $faker->numberBetween(401, 500)
          ],[
            'user_id' => $i,
            'comment_id' => $faker->numberBetween(501, 600)
          ],[
            'user_id' => $i,
            'comment_id' => $faker->numberBetween(601, 700)
          ],[
            'user_id' => $i,
            'comment_id' => $faker->numberBetween(701, 800)
          ],[
            'user_id' => $i,
            'comment_id' => $faker->numberBetween(801, 900)
          ],[
            'user_id' => $i,
            'comment_id' => $faker->numberBetween(901, 1000)
          ],[
            'user_id' => $i,
            'comment_id' => $faker->numberBetween(1001, 1100)
          ],[
            'user_id' => $i,
            'comment_id' => $faker->numberBetween(1101, 1200)
          ],[
            'user_id' => $i,
            'comment_id' => $faker->numberBetween(1201, 1300)
          ],[
            'user_id' => $i,
            'comment_id' => $faker->numberBetween(1301, 1400)
          ],[
            'user_id' => $i,
            'comment_id' => $faker->numberBetween(1401, 1500)
          ],[
            'user_id' => $i,
            'comment_id' => $faker->numberBetween(1501, 1600)
          ],[
            'user_id' => $i,
            'comment_id' => $faker->numberBetween(1601, 1700)
          ],[
            'user_id' => $i,
            'comment_id' => $faker->numberBetween(1701, 1800)
          ],[
            'user_id' => $i,
            'comment_id' => $faker->numberBetween(1801, 1900)
          ],[
            'user_id' => $i,
            'comment_id' => $faker->numberBetween(1901, 2000)
          ]
        ]);
        }
    }
}
