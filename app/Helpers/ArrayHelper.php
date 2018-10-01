<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 1.10.2018
 */

namespace App\Helpers;

abstract class ArrayHelper
{

    public static function replace_keys($dataArray, $keysArray)
    {
        foreach ($keysArray as $oldkey => $newKey) {
            if (array_key_exists($oldkey, $dataArray)) {
                $dataArray[$newKey] = $dataArray[$oldkey];
                unset($dataArray[$oldkey]);
            }
        }

        return $dataArray;
    }

}
