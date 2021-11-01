<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Tools\CreateLinkController;
use App\Http\Controllers\Tools\FileController;
use App\Http\Controllers\Tools\PaginationController;
use App\Http\Requests\StorePictureRequest;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Http\Resources\TagResource;
use App\Http\Traits\FileManagerTrait;
use App\Models\Tag;
use App\Models\Taggable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TagController extends Controller
{
    use FileManagerTrait;

    public function index(Request $request)
    {
        $tags = Tag::query();

        if ($request->filled('search')) {
            $word = $request->input('search');
            $tags = $tags->search($word);
        }

        if ($request->filled('sortBy') && in_array($request->input('sortBy'), ['id', 'name', 'created_at'])) {
            $columnName = $request->input('sortBy');
            if ($request->filled('direction') && in_array($request->input('direction'), ['asc', 'desc'])) {
                $direction = $request->input('direction');
                $tags = $tags->order($columnName, $direction);
            }
        }

        $rpp = $request->filled('rpp')
            ? $request->input('rpp')
            : 5;
        $tags = $tags->paginate($rpp);

        return response($tags, 206);
    }

    public function store(StoreTagRequest $request)
    {
        return Tag::query()->create($request->validated());
    }

    public function show(Tag $tag): TagResource
    {
        return new TagResource($tag);
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update($request->validated());
        return response($tag);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }

    public function uploadPicture(StorePictureRequest $request, Tag $tag)
    {
        $this->deletePicture($tag);
        $path = $this->saveFilesInStorage('picture/', $request->file('picture'));

        $tag->picture = $path;
        $tag->save();

        return response($tag, Response::HTTP_OK);
    }

    public function destroyPicture(Tag $tag)
    {
        $this->deletePicture($tag);
        return response('', Response::HTTP_NO_CONTENT);
    }

    private function deletePicture(Tag $tag)
    {
        if (!is_null($tag->picture)) {
            $this->deleteFileFromStorage($tag->getAttributes()['picture']);

            $tag->picture = null;
            $tag->save();
        }
    }
}
