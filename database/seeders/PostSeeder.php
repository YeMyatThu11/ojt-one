<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();
        Post::factory(40)->create()->each(function ($post) use ($categories) {
            $randArr = $categories->random(rand(1, 4))->pluck('id')->toArray();
            $post->categories()->attach($randArr);
        });
    }
}