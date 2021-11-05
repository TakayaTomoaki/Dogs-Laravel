<?php declare(strict_types=1);

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         $this->call(UsersTableSeeder::class);
        $this->call(DogsProfilesTableSeeder::class);
        $this->call(SharesTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(NicesTableSeeder::class);
    }
}
