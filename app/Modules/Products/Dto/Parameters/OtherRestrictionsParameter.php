<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 06.12.2017
 */

namespace App\Modules\Products\Dto\Parameters;

class OtherRestrictionsParameter extends AbstractParameter implements ParametersInterface
{
    /**
     * @return bool
     */
    public function validate(): bool
    {
        if (!isset($this->values)) {
            return false;
        }
        if (!\is_string($this->values)) {
            return false;
        }
        if (mb_strlen($this->values) > 1000) {
            return false;
        }

        return true;
    }
}
