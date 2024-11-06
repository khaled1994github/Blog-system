<?php

namespace Database\Seeders;

use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AdminSeeder::class
        ]);
        User::factory()->count(5)->create();
        Post::factory()->count(15)->create();

      Comment::factory()
                ->count(500)
                ->state(new Sequence(
                    fn (Sequence $sequence) => ['user_id' => User::where('id','>',1)->get()->random(), 'post_id' => Post::all()->random()],
                ))
                ->create();
    }
}
