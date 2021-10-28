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

    public function test_show()
    {
        $tag = Tag::factory()->create();
        $response = $this->getJson(route('tag.show', $tag->id))
            ->assertOk()
            ->json();

        $this->assertEquals($tag->name, $response['name']);
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
