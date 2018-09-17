<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 12.12.2017
 */

namespace App\Modules\Products\Dto\Parameters;

use App\Modules\Products\Helpers\DtoValidatorHelper;

class NotValidOnHolidaysParameter extends AbstractParameter implements ParametersInterface
{
    /**
     * @return bool
     */
    public function validate(): bool
    {
        if (!DtoValidatorHelper::checkBool($this->values)) {
            return false;
        }

        return true;
    }
}
