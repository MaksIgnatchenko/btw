<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 03.04.2018
 */

namespace App\Modules\Csv\Generator;

interface GenerateCsvInterface
{
    /**
     * @return array
     */
    public function generate(): array;
}
