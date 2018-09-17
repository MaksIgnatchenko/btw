<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 23.11.2017
 */

namespace App\Modules\Categories\Helpers;

use App\Modules\Categories\Enums\AttributeTypesEnum;
use App\Modules\Categories\Enums\ParameterTypesEnum;
use App\Modules\Categories\Models\Category;

class DisplayValues
{
    /**
     * @param string $string
     * @param string $value
     *
     * @return string
     */
    public static function get(string $string, string $value): string
    {
        return \GuzzleHttp\json_decode($string)->$value;
    }

    // TODO объединить?
    /**
     * @param string $string
     *
     * @return string
     */
    public static function getParameterNameText(string $string): string
    {
        $name = \GuzzleHttp\json_decode($string)->name;

        if (ParameterTypesEnum::check($name)) {
            return ParameterTypesEnum::toArray()[$name];
        }

        return $name;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public static function getAttributeTypeText(string $string): string
    {
        $type = \GuzzleHttp\json_decode($string)->type;

        if (AttributeTypesEnum::check($type)) {
            return AttributeTypesEnum::toArray()[$type];
        }

        return $type;
    }

    // TODO объединить???
    /**
     * @param Category $category
     * @param array|null $oldAttributes
     *
     * @return array
     */
    public static function getAttributes(Category $category = null, array $oldAttributes = null): array
    {
        if (null !== $oldAttributes) {
            return $oldAttributes;
        }
        if (null !== $category && null !== $category->attributes) {
            return $category->attributes;
        }

        return [];
    }

    /**
     * @param Category $category
     * @param array|null $oldParameters
     *
     * @return array
     */
    public static function getParameters(Category $category = null, array $oldParameters = null): array
    {
        if (null !== $oldParameters) {
            return $oldParameters;
        }
        if (null !== $category && null !== $category->parameters) {
            return $category->parameters;
        }

        return [];
    }

    /**
     * @return array
     */
    public static function getParametersData(): array
    {
        return ParameterTypesEnum::toArray();
    }

    /**
     * @return string
     */
    public static function getDefaultParameter(): string
    {
        return ParameterTypesEnum::COUNT;
    }

    /**
     * @return array
     */
    public static function getAttributesData(): array
    {
        return AttributeTypesEnum::toArray();
    }

    /**
     * @return string
     */
    public static function getDefaultAttribute(): string
    {
        return AttributeTypesEnum::DIGITS;
    }
}
