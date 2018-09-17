<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 01.02.2018
 */

namespace App\Helpers;

class PreparedStatementsHelper
{
    /**
     * @param float $latitude
     * @param float $longitude
     *
     * @return string
     */
    public static function getDistanceSql(float $latitude, float $longitude): string
    {
        return "(3958 * acos(cos(radians({$latitude})) * cos(radians(latitude)) * cos(radians(longitude) - radians ({$longitude})) + sin(radians({$latitude})) * sin(radians(latitude))))";
    }
}
