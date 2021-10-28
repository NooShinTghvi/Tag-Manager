<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    //$request->file('file')->extension()
    //$request->file('file')
    public function save($path, $file): string
    {
        $newName = App::make(GenerateNameController::class)(15) . '.' . $file->extension();
        while (Storage::exists('public/' . $path . $newName)) {
            $newName = App::make(GenerateNameController::class)(15) . '.' . $file->extension();
        }
        Storage::putFileAs('public/' . $path, $file, $newName);
        return $path . $newName;
    }

    public function delete($name)
    {
        Storage::delete('public/' . $name);
    }
}
