<?php

use App\Models\Nice;
use Illuminate\Database\Seeder;

class NicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Nice::class, 300)->create();
    }
}
