<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.01.2018
 */

namespace App\Modules\Products\Factory;

use App\Modules\Products\Enums\UpdateCartActionEnum;
use App\Modules\Products\Exceptions\WrongOperationActionException;

class ChangeQuantityFactory
{
    /**
     * @param string $action
     *
     * @return ChangeCartQuantityInterface
     * @throws WrongOperationActionException
     */
    public static function getOperation(string $action): ChangeCartQuantityInterface
    {
        switch ($action) {
            case UpdateCartActionEnum::INCREMENT:
                return new IncrementCartQuantity();
            case UpdateCartActionEnum::DECREMENT:
                return new DecrementCartQuantity();
            default:
                throw new WrongOperationActionException("No such operation action - {$action}");
        }
    }
}
