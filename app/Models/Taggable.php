<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taggable extends Model
{
    use HasFactory;

    protected $fillable = ['tag_id', 'taggable_type', 'taggable_id'];

    protected $hidden = ['tag_id', 'taggable_type', 'taggable_id', 'created_at', 'updated_at'];
}
