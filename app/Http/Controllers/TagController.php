<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Tools\PaginationController;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $tags = Tag::query()->get();

        if ($request->filled('search')) {
            $word = $request->input('search');
            $tags = $tags->filter(function ($item) use ($word) {
                return strpos($item->name, $word) !== false;
            });
        }

        if ($request->filled('sortBy') && $request->filled('isDesc'))
            if (in_array($request->filled('sortBy'), ['id', 'name', 'created_at']))
                $tags = $tags->sortBy($request->input('sortBy'), SORT_REGULAR, $request->input('isDesc'));

        $tags = App::make(PaginationController::class)($request, $tags);

        return response($tags, 206);
    }

    public function store(StoreTagRequest $request)
    {
        return Tag::query()->create($request->validated());
    }

    public function show(Tag $tag): Tag
    {
        return $tag;
    }

    public function update(Tag $tag, UpdateTagRequest $request)
    {
        $tag->update($request->validated());
        return response($tag);
    }

    public function destroy()
    {

    }
}
