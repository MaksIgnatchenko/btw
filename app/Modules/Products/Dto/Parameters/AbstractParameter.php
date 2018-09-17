<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 06.12.2017
 */

namespace App\Modules\Products\Dto\Parameters;

abstract class AbstractParameter
{
    /** @var mixed */
    protected $values;

    /**
     * @return mixed
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param $values
     *
     * @return AbstractParameter
     */
    public function setValues($values): self
    {
        $this->values = $values;

        return $this;
    }
}
