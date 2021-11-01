<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use App\Models\Taggable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class LabelingController extends Controller
{
    public function add(Tag $tag, $type, $id)
    {
        if (!in_array($type, ['Article', 'Product']))
            return response('URL path is not correct', Response::HTTP_BAD_REQUEST);

        $model = 'App\Models\\' . $type;
        if (!$this->isObjExist($model, $id))
            return response($type . ' does not exist', Response::HTTP_NOT_FOUND);

        if ($this->isRepeated($tag->id, $model, $id))
            return response('relation was created', Response::HTTP_CONFLICT);

        $object = App::make($model)->find($id);
        return $object->addTag($tag->id);
    }

    private function isObjExist($model, $id)
    {
        return App::make($model)->where('id', $id)->exists();
    }

    private function isRepeated($tagId, $model, $id): bool
    {
        return Taggable::query()
            ->where('tag_id', $tagId)
            ->where('taggable_type', $model)
            ->where('taggable_id', $id)
            ->exists();
    }

    public function remove(Tag $tag, $type, $id)
    {
        if (!in_array($type, ['Article', 'Product']))
            return response('URL path is not correct', Response::HTTP_BAD_REQUEST);

        $model = 'App\Models\\' . $type;
        if (!$this->isObjExist($model, $id))
            return response($type . ' does not exist', Response::HTTP_NOT_FOUND);

        if (!Taggable::search($tag->id, $model, $id)->exists())
            return response('', Response::HTTP_NOT_FOUND);

        Taggable::search($tag->id, $model, $id)->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }
}
