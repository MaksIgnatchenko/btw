<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 03.04.2018
 */

namespace App\Modules\Csv\Enums;

class CsvGeneratorTypeEnum
{
    public const CUSTOMERS = 'customers';
    public const MERCHANTS = 'merchants';
    public const INCOME = 'income';
    public const PAYOUT = 'payout';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::CUSTOMERS,
            self::MERCHANTS,
            self::INCOME,
            self::PAYOUT,
        ];
    }

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::CUSTOMERS => 'Customers',
            self::MERCHANTS => 'Merchants',
            self::INCOME    => 'Income',
            self::PAYOUT    => 'Payout',
        ];
    }
}
