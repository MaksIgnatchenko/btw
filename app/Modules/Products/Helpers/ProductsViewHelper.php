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

        return self::getValidTemplate($requestedTemplate);
    }

    /**
     * @param string $requestedTemplate
     * @return bool
     */
    public static function checkTemplate(string $requestedTemplate): bool
    {
        return $requestedTemplate === self::getTemplateFromSession();
    }

    /**
     * @param string $requestedTemplate
     * @return string
     */
    public static function getValidTemplate(string $requestedTemplate): string
    {
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
     * @return string
     */
    public static function getTemplateFromSession(): string
    {
        if (request()->session()->exists('template')) {
            $template = request()->session()->get('template');
        } else {
            $template = ProductsViewTemplateEnum::GALLERY;
        }

        return self::getValidTemplate($template);
    }

    /**
     * @return void
     */
    public static function storeTemplateToSession(): void
    {
        if (request()->get('template')) {
            request()->session()->put('template', self::getTemplate());
        }
    }

    /**
     * @return bool
     */
    public static function isSearchResults(): bool
    {
        return null !== request()->get('search');
    }
}
