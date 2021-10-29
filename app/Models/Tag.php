<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $picture
 * @property mixed $articles
 * @property mixed $products
 */
class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    protected $hidden = ['articles', 'products', 'created_at', 'updated_at'];

    public function articles(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(Product::class, 'taggable');
    }
}
