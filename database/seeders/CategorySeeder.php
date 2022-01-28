<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Health']);
        Category::create(['name' => 'Food']);
        Category::create(['name' => 'Travel']);
        Category::create(['name' => 'Photography']);
    }
}