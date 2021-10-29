<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Politics']);
        Category::create(['name' => 'Sport']);
        Category::create(['name' => 'Music']);

        Post::factory(10)->create();
        // \App\Models\User::factory(10)->create();
    }
}
