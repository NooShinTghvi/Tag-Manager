<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $id
 * @property mixed $name
 */
class Article extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $hidden = ['created_at', 'updated_at'];

    public function tags(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function addTag($tagId)
    {
//        $this->tags()->attach($tagId);
        return Taggable::query()->create([
            'tag_id' => $tagId,
            'taggable_type' => 'App\Models\Article',
            'taggable_id' => $this->id,
        ]);
    }
}
