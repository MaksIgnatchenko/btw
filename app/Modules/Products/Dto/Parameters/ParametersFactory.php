<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 05.12.2017
 */

namespace App\Modules\Products\Dto\Parameters;

use App\Modules\Categories\Enums\ParameterTypesEnum;
use App\Modules\Products\Exceptions\WrongParametersFormatException;

class ParametersFactory
{
    /**
     * @param string $type
     * @param string|\stdClass $values
     *
     * @return ParametersInterface
     * @throws WrongParametersFormatException
     */
    public static function get(string $type, $values): ParametersInterface
    {
        if (ParameterTypesEnum::VALID_DATE === $type) {
            return (new ValidDateParameter())->setValues($values);
        }
        if (ParameterTypesEnum::OTHER_RESTRICTIONS === $type) {
            return (new OtherRestrictionsParameter())->setValues($values);
        }
        if (ParameterTypesEnum::COUNT === $type) {
            return (new CountParameter())->setValues($values);
        }
        if (ParameterTypesEnum::NOT_VALID_ON_HOLIDAYS === $type) {
            return (new NotValidOnHolidaysParameter())->setValues($values);
        }

        throw new WrongParametersFormatException("No such parameter type - {$type}");
    }
}
