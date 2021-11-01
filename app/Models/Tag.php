<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $picture
 * @property mixed $articles
 * @property mixed $products
 * @method static search(mixed $word)
 */
class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    protected $hidden = ['created_at', 'updated_at'];

    public function getPictureAttribute($value): ?string
    {
        if (is_null($value))
            return null;
        else
            return config('app.url') . Storage::url($value);
    }

    public function scopeSearch($query, $word)
    {
        return $query->where('name', 'like', '%' . $word . '%');
    }

    public function scopeOrder($query, $col, $direction)
    {
        return $query->orderBy($col, $direction);
    }

    public function articles(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(Product::class, 'taggable');
    }
}
