<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 12.11.2018
 */

namespace App\Modules\Products\Helpers;

use App\Modules\Categories\Enums\AttributeTypesEnum;

class AttributesHelper
{
    /**
     * @param array $attributes
     * @return array
     */
    public static function mergeAttributes(array $attributes): array
    {
        $mergedAttributes = [];

        foreach ($attributes as $type => $attributeArray) {
            if (AttributeTypesEnum::check($type)) {

                // TODO is it should be refactored??
                foreach ($attributeArray as $key => $value) {
                    $mergedAttributes[$key] = [
                        'type' => $type,
                        'value' => $value,
                    ];
                }
            }
        }

        return $mergedAttributes;
    }
}
