<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait FileManagerTrait
{
    use GenerateNameTrait;

    public function saveFilesInStorage($path, $file): string
    {
        $newName = $this->generateName(15) . '.' . $file->extension();
        while (Storage::exists('public/' . $path . $newName)) {
            $newName = $this->generateName(15) . '.' . $file->extension();
        }
        Storage::putFileAs('public/' . $path, $file, $newName);
        return $path . $newName;
    }

    public function deleteFileFromStorage($name)
    {
        Storage::delete('public/' . $name);
    }
}
