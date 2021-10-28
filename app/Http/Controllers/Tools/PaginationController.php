<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PaginationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param $items
     * @return LengthAwarePaginator
     */
    public function __invoke(Request $request, $items): LengthAwarePaginator
    {
        $rpp = $request->filled('rpp')
            ? $request->input('rpp')
            : 5;
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator(
            array_values($items->forPage($request->filled('page') ? $request->input('page') : 1, $rpp)->toArray()),
            $items->count(),
            $rpp,
            $request->filled('page') ? $request->input('page') : 1,
            ['path' => $request->url()]
        );
    }
}
