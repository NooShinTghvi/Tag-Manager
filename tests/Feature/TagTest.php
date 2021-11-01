<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;

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

    public function test_show()
    {
        $tag = Tag::factory()
            ->has(Article::factory()->count(3))
            ->has(Product::factory()->count(5))
            ->create();
        $response = $this->getJson(route('tag.show', $tag->id))
            ->assertOk()
            ->json();
        $this->assertEquals($tag->name, $response['data']['info']['name']);
        $this->assertCount(3, $response['data']['articles']);
        $this->assertCount(5, $response['data']['products']);
    }

    public function test_update()
    {
        $tag = Tag::factory()->create();
        $newTag = Tag::factory()->make();
        $response = $this->patchJson(route('tag.update', $tag->id), [
            'name' => $newTag->name,
            'slug' => $newTag->slug,
        ])
            ->assertOk()
            ->json();

        $this->assertEquals($newTag->name, $response['name']);
    }

    public function test_destroy()
    {
        $tag = Tag::factory()->create();
        $this->deleteJson(route('tag.destroy', $tag->id))
            ->assertNoContent();

        $this->assertDatabaseMissing('tags', ['id' => $tag->id]);
    }
}
