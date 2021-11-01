<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Product;
use App\Models\Tag;
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
//        Tag::factory(1000)->create();
        Product::factory(100)->create();
        Article::factory(100)->create();
    }
}
