<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 05.12.2017
 */

namespace App\Modules\Products\Dto\Parameters;

interface ParametersInterface
{
    /**
     * @return bool
     */
    public function validate(): bool;
}