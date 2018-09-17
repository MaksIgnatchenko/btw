<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.01.2018
 */

namespace App\Modules\Products\Enums;

class TransactionStatusEnum
{
    public const PENDING = 'pending';
    public const SUCCESS = 'success';
    public const FAIL = 'fail';

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            'Pending' => self::PENDING,
            'Success' => self::SUCCESS,
            'Fail'    => self::FAIL
        ];
    }
}
