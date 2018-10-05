<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 4.10.2018
 */

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class StorageHelper
{
    /**
     * @param      $file
     * @param null $path
     *
     * @return string
     */
    public static function upload($file, $path = null): string
    {
        $fileName = str_random(30) . '.' . $file->extension();
        $filePath = $path . $fileName;

        Storage::put($filePath, file_get_contents($file));

        return $filePath;
    }
}