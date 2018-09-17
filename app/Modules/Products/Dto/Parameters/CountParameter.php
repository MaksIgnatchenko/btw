<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 06.12.2017
 */

namespace App\Modules\Products\Dto\Parameters;

class CountParameter extends AbstractParameter implements ParametersInterface
{
    /**
     * @return bool
     */
    public function validate(): bool
    {
        if (!ctype_digit($this->values)) {
            return false;
        }

        if (0 > $this->values) {
            return false;
        }

        return true;
    }
}
