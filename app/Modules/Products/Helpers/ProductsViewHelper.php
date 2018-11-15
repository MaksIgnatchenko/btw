<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 13.11.2018
 */

namespace App\Modules\Products\Helpers;

use App\Modules\Products\Enums\ProductsViewTemplateEnum;
use Illuminate\Http\Request;

class ProductsViewHelper
{
    /**
     * @return string
     */
    protected static function getTemplate(): string
    {
        $request = app()[Request::class];
        $requestedTemplate = $request->get('template', ProductsViewTemplateEnum::GALLERY);

        return self::getValidTemplate($requestedTemplate);
    }

    /**
     * @return string
     */
    protected static function getTemplateFromSession(): string
    {
        $request = app()[Request::class];
        $session = $request->session();

        if ($session->exists('template')) {
            $template = $session->get('template');
        } else {
            $template = ProductsViewTemplateEnum::GALLERY;
        }


        return self::getValidTemplate($template);
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
     * @return void
     */
    public static function storeTemplateToSession(): void
    {
        $request = app()[Request::class];

        if ($request->get('template')) {
            $request->session()->put('template', self::getTemplate());
        }
    }

    /**
     * @return bool
     */
    public static function isSearchResults(): bool
    {
        $request = app()[Request::class];

        return null !== $request->get('search');
    }
}
