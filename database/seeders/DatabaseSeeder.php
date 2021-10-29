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
        Tag::factory(15)->create();
        Product::factory(15)->create();
        Article::factory(15)->create();
    }
}
