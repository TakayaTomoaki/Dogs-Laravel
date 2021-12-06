<?php declare(strict_types=1);

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Comment::class, 2000)->create();
    }
}
