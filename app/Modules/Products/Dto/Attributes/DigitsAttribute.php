<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 05.12.2017
 */

namespace App\Modules\Products\Dto\Attributes;

use App\Modules\Categories\Enums\AttributeTypesEnum;

class DigitsAttribute extends AbstractAttributes implements AttributesInterface
{
    /**
     * @return bool
     */
    public function validate(): bool
    {
        if (AttributeTypesEnum::DIGITS !== $this->type) {
            return false;
        }
        if (!ctype_digit($this->value)) {
            return false;
        }
        if ((int)$this->value > 1000) {
            return false;
        }
        if (mb_strlen($this->name) > 1000) {
            return false;
        }

        return true;
    }
}
