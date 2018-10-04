<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 4.10.2018
 */

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class StorageHelper
{
    public static function upload($file):string
    {
        $fileName = str_random(30) . '.' . $file->extension();
        $filePath = 'public/' . $fileName;

        Storage::put($filePath, file_get_contents($file));

        return asset('storage/' . $fileName);
    }
}