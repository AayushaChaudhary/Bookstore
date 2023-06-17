<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Romance']);
        Category::create(['name' => 'Adventure']);
        Category::create(['name' => 'Fantasy']);
        Category::create(['name' => 'Biography']);
        Category::create(['name' => 'Science Fiction']);

        Author::create(['name' => 'Author A']);
        Author::create(['name' => 'Author B']);
        Author::create(['name' => 'Author C']);
        Author::create(['name' => 'Author D']);
        Author::create(['name' => 'Author E']);

        Publisher::create(['name' => 'Publisher One']);
        Publisher::create(['name' => 'Publisher Two']);
        Publisher::create(['name' => 'Publisher Three']);
        Publisher::create(['name' => 'Publisher Four']);
        Publisher::create(['name' => 'Publisher Five']);
    }
}
