<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Taggable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LabelingTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_product()
    {
        $tag = Tag::factory()->create();
        $product = Product::factory()->create();

        $response = $this->postJson(
            route('labeling.add', [
                $tag->id,
                'Product',
                $product->id
            ]))
            ->assertCreated()
            ->json();

        $this->assertDatabaseHas('taggables', [
            'id' => $response['id'],
            'tag_id' => $tag->id,
            'taggable_type' => 'App\Models\Product',
            'taggable_id' => $product->id
        ]);
    }

    public function test_add_article()
    {
        $tag = Tag::factory()->create();
        $article = Article::factory()->create();
        $response = $this->postJson(
            route('labeling.add', [
                $tag->id,
                'Article',
                $article->id
            ]))
            ->assertCreated()
            ->json();

        $this->assertDatabaseHas('taggables', [
            'id' => $response['id'],
            'tag_id' => $tag->id,
            'taggable_type' => 'App\Models\Article',
            'taggable_id' => $article->id
        ]);
    }

    public function test_remove()
    {
        $article = Article::factory()->create();
        $tag = Tag::factory()->create();
        $taggable = Taggable::query()->create([
            'tag_id' => $tag->id,
            'taggable_type' => 'App\Models\Article',
            'taggable_id' => $article->id
        ]);

        $response = $this->deleteJson(route('labeling.remove', $taggable->id))
            ->assertNoContent();

        $this->assertDatabaseMissing('taggables', [
            'id' => $taggable->id
        ]);
    }
}
