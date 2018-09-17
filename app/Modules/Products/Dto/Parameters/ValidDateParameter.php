<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 06.12.2017
 */

namespace App\Modules\Products\Dto\Parameters;

use App\Modules\Products\Exceptions\WrongParametersFormatException;
use App\Modules\Products\Helpers\DtoValidatorHelper;

class ValidDateParameter extends AbstractParameter implements ParametersInterface
{
    /**
     * @return bool
     * @throws \App\Modules\Products\Exceptions\WrongParametersFormatException
     */
    public function validate(): bool
    {
        // TODO make prettier one day...
        if (!isset($this->values->valid_day_from)) {
            throw new WrongParametersFormatException('No valid_day_from');
        }
        if (!isset($this->values->valid_day_to)) {
            throw new WrongParametersFormatException('No valid_day_to');
        }
        if (!isset($this->values->valid_time_from)) {
            throw new WrongParametersFormatException('No valid_time_from');
        }
        if (!isset($this->values->valid_time_to)) {
            throw new WrongParametersFormatException('No valid_time_to');
        }

        if (!DtoValidatorHelper::checkDay($this->values->valid_day_from)) {
            throw new WrongParametersFormatException("Wrong valid_day_from: {$this->values->valid_day_from}");
        }
        if (!DtoValidatorHelper::checkDay($this->values->valid_day_to)) {
            throw new WrongParametersFormatException("Wrong valid_day_to: {$this->values->valid_day_to}");
        }
        if (!DtoValidatorHelper::checkTime($this->values->valid_time_from)) {
            throw new WrongParametersFormatException("Wrong valid_time_from: {$this->values->valid_time_from}");
        }
        if (!DtoValidatorHelper::checkTime($this->values->valid_time_to)) {
            throw new WrongParametersFormatException("Wrong valid_time_to: {$this->values->valid_time_to}");
        }

        return true;
    }
}
