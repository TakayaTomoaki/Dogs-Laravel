<?php

use App\Models\Dogs_profile;
use Illuminate\Database\Seeder;

class DogsProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Dogs_profile::class, 200)->create();
    }
}