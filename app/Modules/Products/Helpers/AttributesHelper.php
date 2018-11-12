<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 12.11.2018
 */

namespace App\Modules\Products\Helpers;

use App\Modules\Categories\Enums\AttributeTypesEnum;

class AttributesHelper
{
    /**
     * @param array|null $attributes
     * @return array|null
     */
    public static function mergeAttributes(?array $attributes): ?array
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
