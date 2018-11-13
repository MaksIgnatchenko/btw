<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 13.11.2018
 */

namespace App\Modules\Products\Helpers;

use App\Modules\Products\Enums\ProductsViewTemplateEnum;

class ProductsViewHelper
{
    /**
     * @return string
     */
    public static function getTemplate(): string
    {
        $requestedTemplate = request()->get('template', ProductsViewTemplateEnum::GALLERY);

        switch ($requestedTemplate) {
            case ProductsViewTemplateEnum::GALLERY:
                $template = ProductsViewTemplateEnum::GALLERY;
                break;
            case ProductsViewTemplateEnum::LIST:
                $template = ProductsViewTemplateEnum::LIST;
                break;
            default:
                $template = ProductsViewTemplateEnum::GALLERY;
        }

        return $template;
    }

    /**
     * @param string $requestedTemplate
     * @return bool
     */
    public static function checkTemplate(string $requestedTemplate): bool
    {
        return $requestedTemplate === self::getTemplate();
    }
}
