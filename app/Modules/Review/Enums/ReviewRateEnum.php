<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 27.12.2017
 */

namespace App\Modules\Reviews\Enums;

class ReviewRateEnum
{
    public const ONE_STAR = 1;
    public const TWO_STAR = 2;
    public const THREE_STAR = 3;
    public const FOUR_STAR = 4;
    public const FIVE_STAR = 5;

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [self::ONE_STAR, self::TWO_STAR, self::THREE_STAR, self::FOUR_STAR, self::FIVE_STAR];
    }

    /**
     * @return string
     */
    public static function toString(): string
    {
        return self::ONE_STAR
            . ',' . self::TWO_STAR
            . ',' . self::THREE_STAR
            . ',' . self::FOUR_STAR
            . ',' . self::FIVE_STAR;
    }

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::ONE_STAR   => 'One star',
            self::TWO_STAR   => 'Two stars',
            self::THREE_STAR => 'Three stars',
            self::FOUR_STAR  => 'Four stars',
            self::FIVE_STAR  => 'Five stars',
        ];
    }
}
