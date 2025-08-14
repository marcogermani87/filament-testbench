<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)
            ->create()
            ->pluck('id');

        Blog::factory(500)
            ->create([
                'author_id' => function() use($users) {
                    return $users->random();
                }
            ]);
    }
}
