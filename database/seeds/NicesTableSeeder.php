<?php declare(strict_types=1);

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class NicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 1; $i <= 300; $i++) {
            DB::table('nices')->insert([
          [
            'user_id' => $i,
            'share_id' => $faker->numberBetween(1, 50),
          ], [
            'user_id' => $i,
            'share_id' => $faker->numberBetween(51, 100),
          ], [
            'user_id' => $i,
            'share_id' => $faker->numberBetween(101, 150),
          ], [
            'user_id' => $i,
            'share_id' => $faker->numberBetween(151, 200),
          ], [
            'user_id' => $i,
            'share_id' => $faker->numberBetween(201, 250),
          ], [
            'user_id' => $i,
            'share_id' => $faker->numberBetween(251, 300),
          ], [
            'user_id' => $i,
            'share_id' => $faker->numberBetween(301, 350),
          ], [
            'user_id' => $i,
            'share_id' => $faker->numberBetween(351, 400),
          ], [
            'user_id' => $i,
            'share_id' => $faker->numberBetween(401, 450),
          ], [
            'user_id' => $i,
            'share_id' => $faker->numberBetween(451, 500),
          ], [
            'user_id' => $i,
            'share_id' => $faker->numberBetween(501, 550),
          ], [
            'user_id' => $i,
            'share_id' => $faker->numberBetween(551, 600),
          ], [
            'user_id' => $i,
            'share_id' => $faker->numberBetween(601, 650),
          ], [
            'user_id' => $i,
            'share_id' => $faker->numberBetween(651, 700),
          ], [
            'user_id' => $i,
            'share_id' => $faker->numberBetween(701, 750),
          ], [
            'user_id' => $i,
            'share_id' => $faker->numberBetween(751, 800),
          ], [
            'user_id' => $i,
            'share_id' => $faker->numberBetween(801, 850),
          ], [
            'user_id' => $i,
            'share_id' => $faker->numberBetween(851, 900),
          ], [
            'user_id' => $i,
            'share_id' => $faker->numberBetween(901, 950),
          ], [
            'user_id' => $i,
            'share_id' => $faker->numberBetween(951, 1000),
          ]
      ]);
        }
    }
}
