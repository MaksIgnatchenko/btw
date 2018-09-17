<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 05.12.2017
 */

namespace App\Modules\Products\Dto\Attributes;

interface AttributesInterface
{
    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getValue(): string;

    /**
     * @return bool
     */
    public function validate(): bool;
}
