<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Tools\CreateLinkController;
use App\Http\Controllers\Tools\FileController;
use App\Http\Controllers\Tools\PaginationController;
use App\Http\Requests\StorePictureRequest;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

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

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update($request->validated());
        return response($tag);
    }

    public function destroy()
    {

    }

    public function uploadPicture(StorePictureRequest $request, Tag $tag)
    {
        $this->deletePicture($tag);
        $path = App::make(FileController::class)->save('picture/', $request->file('picture'));

        $tag->picture= $path;
        $tag->save();

        $tag->picture = App::make(CreateLinkController::class)($tag->picture);
        return response($tag, Response::HTTP_OK);
    }

    public function destroyPicture(Tag $tag)
    {
        $this->deletePicture($tag);
        return response('', Response::HTTP_NO_CONTENT);
    }

    private function deletePicture(Tag $tag)
    {
        if (!is_null($tag->picture)){
            App::make(FileController::class)->delete($tag->picture);

            $tag->picture= null;
            $tag->save();
        }
    }
}
