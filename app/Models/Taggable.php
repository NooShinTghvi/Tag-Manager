<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static search(mixed $id, string $model, $id1)
 */
class Taggable extends Model
{
    use HasFactory;

    protected $fillable = ['tag_id', 'taggable_type', 'taggable_id'];

    protected $hidden = ['tag_id', 'taggable_type', 'taggable_id', 'created_at', 'updated_at'];

    public function scopeSearch($query, $tagId, $model, $modeId)
    {
        return $query->where('tag_id', $tagId)
            ->where('taggable_type', $model)
            ->where('taggable_id', $modeId);
    }
}
