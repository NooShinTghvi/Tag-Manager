<?php

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create()
    {
        $tag = Tag::factory()->make();
        $response = $this->postJson(route('tag.store'), [
            'name' => $tag->name,
            'slug' => $tag->slug,
            'description' => $tag->description
        ])
            ->assertCreated()
            ->json();

        $this->assertDatabaseHas('tags', [
            'name' => $tag->name,
            'slug' => $tag->slug,
            'description' => $tag->description
        ]);
    }
}
