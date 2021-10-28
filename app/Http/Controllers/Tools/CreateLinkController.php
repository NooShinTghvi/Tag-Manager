<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CreateLinkController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param $item
     * @param string $type
     * @return string
     */
    public function __invoke($item, string $type = 'back'): ?string
    {
        if (is_null($item))
            return null;
        if ($type == 'front')
            return config('app.url') . '/' . $item;
        else
            return config('app.url') . Storage::url($item);
    }
}
