<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 12.11.2018
 */

namespace App\Modules\Products\Helpers;

use App\Modules\Categories\Enums\AttributeTypesEnum;

class AttributesHelper
{
    public static function mergeAttributes(?array $attributes)
    {
        $mergedAttributes = [];

        if ($attributes === null) {
            return null;
        }

        foreach ($attributes as $type => $attributeArray) {
            if (AttributeTypesEnum::check($type)) {
                $mergedAttributes = array_merge($mergedAttributes, $attributeArray);
            }
        }

        return $mergedAttributes;
    }
}
