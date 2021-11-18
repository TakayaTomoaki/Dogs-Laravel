<?php declare(strict_types=1);

use App\Models\Share;
use Illuminate\Database\Seeder;

class SharesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Share::class, 500)->create();
    }
}
