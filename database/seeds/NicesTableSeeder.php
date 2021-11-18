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
        for ($i = 1; $i <= 200; $i++) {
            DB::table('nices')->insert([
        [
          'user_id' => $i,
          'share_id' => $faker->numberBetween(1, 100),
        ], [
          'user_id' => $i,
          'share_id' => $faker->numberBetween(101, 200),
        ], [
          'user_id' => $i,
          'share_id' => $faker->numberBetween(201, 300),
        ], [
          'user_id' => $i,
          'share_id' => $faker->numberBetween(301, 400),
        ], [
          'user_id' => $i,
          'share_id' => $faker->numberBetween(401, 500),
        ]
      ]);
        }
    }
}
