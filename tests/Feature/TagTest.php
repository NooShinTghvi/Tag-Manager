<?php

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagTest extends TestCase
{
//    use RefreshDatabase;

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

    public function test_index()
    {
//        $tag = Tag::query()->paginate(5);
        $response = $this->getJson(route('tag.index'))
            ->assertStatus(206)
            ->json();
//        $this->assertCount(sizeof($tag), $response['data']);
    }
}
