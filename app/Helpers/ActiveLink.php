<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 21.11.2017
 */

namespace App\Helpers;

use App\Modules\Categories\Http\Controllers\Admin\CategoriesController;
use App\Modules\Content\Http\Controllers\Admin\ContentController;
use App\Modules\Users\Admin\Http\Controllers\DashboardController;
use App\Modules\Users\Customer\Http\Controllers\Admin\CustomerController;
use App\Modules\Users\Merchant\Http\Controllers\Admin\MerchantController;
use Illuminate\Support\Facades\Request;

class ActiveLink
{
    /**
     * @return bool
     */
    public static function checkCustomers(): bool
    {
        $controller = self::getControllerInstance();

        return $controller instanceof CustomerController;
    }

    /**
     * @return bool
     */
    public static function checkMerchants(): bool
    {
        $controller = self::getControllerInstance();

        return $controller instanceof MerchantController;
    }

    /**
     * @return bool
     */
    public static function checkCategories(): bool
    {
        $controller = self::getControllerInstance();

        return $controller instanceof CategoriesController;
    }

    /**
     * @return bool
     */
    public static function checkAboutUs(): bool
    {
        $controller = self::getControllerInstance();

        return ($controller instanceof ContentController) && (Request::route()->getName() === 'content.about-us');
    }

    /**
     * @return bool
     */
    public static function checkTermsAndConditions(): bool
    {
        $controller = self::getControllerInstance();

        return ($controller instanceof ContentController) && (Request::route()->getName() === 'content');
    }

    /**
     * @return bool
     */
    public static function checkDasboard(): bool
    {
        $controller = self::getControllerInstance();

        return $controller instanceof DashboardController;
    }

    /**
     * @return bool
     */
    public static function checkManagement(): bool
    {
        $controller = self::getControllerInstance();

        if ($controller instanceof CustomerController) {
            return true;
        }

        if ($controller instanceof MerchantController) {
            return true;
        }

        return false;
    }

    /**
     * @return mixed
     */
    public static function getControllerInstance()
    {
        return Request::route()->getController();
    }
}
