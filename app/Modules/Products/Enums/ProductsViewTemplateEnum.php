<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 13.11.2018
 */

namespace App\Modules\Products\Enums;

class ProductsViewTemplateEnum
{
    public const GALLERY = 'gallery';
    public const LIST = 'list';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::GALLERY,
            self::LIST,
        ];
    }
}
