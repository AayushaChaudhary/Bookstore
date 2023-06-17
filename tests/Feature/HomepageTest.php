<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomepageTest extends TestCase
{
    use RefreshDatabase;
    public function test_it_loads_homepage()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_can_search_for_post()
    {
        $response = $this->get('/search?q=post');

        $response->assertStatus(200);
    }
    public function test_can_load_categories_page()
    {
        // Category::create(['name' => 'Category one']);
        $response = $this->get('/categories');

        $response->assertStatus(200);
    }
}
