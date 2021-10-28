<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\StoreRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {

    }

    public function store(StoreRequest $request)
    {
        return Tag::query()->create($request->validated());
    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
