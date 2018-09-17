<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 05.12.2017
 */

namespace App\Modules\Products\Dto\Attributes;

use App\Modules\Categories\Enums\AttributeTypesEnum;
use App\Modules\Products\Exceptions\WrongAttributesFormatException;

class AttributesDtoFactory
{
    /**
     * @param string $name
     * @param \stdClass $data
     *
     * @return AttributesInterface
     * @throws WrongAttributesFormatException
     */
    public static function get(string $name, \stdClass $data): AttributesInterface
    {
        if (AttributeTypesEnum::TEXT === $data->type) {
            return (new TextAttribute())
                ->setName($name)
                ->setType($data->type)
                ->setValue($data->value);
        }
        if (AttributeTypesEnum::DIGITS === $data->type) {
            return (new DigitsAttribute())
                ->setName($name)
                ->setType($data->type)
                ->setValue($data->value);
        }

        throw new WrongAttributesFormatException("No such attributes type - {$data->type}");
    }
}
