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
        for ($i = 1; $i <= 200; $i++) {
            DB::table('likes')->insert([
          [
          'user_id' => $i,
          'comment_id' => $faker->numberBetween(1, 200)
        ],[
          'user_id' => $i,
          'comment_id' => $faker->numberBetween(201, 400)
        ],[
          'user_id' => $i,
          'comment_id' => $faker->numberBetween(401, 600)
        ],[
          'user_id' => $i,
          'comment_id' => $faker->numberBetween(601, 800)
        ],[
            'user_id' => $i,
            'comment_id' => $faker->numberBetween(801, 1000)
          ]
        ]);
        }
    }
}
