<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 21.11.2017
 */

namespace App\Helpers;

use Illuminate\Support\Facades\Request;

class ActiveLink
{
    /**
     * @return bool
     */
    public static function checkManagement(): bool
    {
        if (Request::is('admin/customers/*')) {
            return true;
        }
        if (Request::is('admin/customers')) {
            return true;
        }
        if (Request::is('admin/merchants/*')) {
            return true;
        }
        if (Request::is('admin/merchants')) {
            return true;
        }
        if (Request::is('admin/categories/*')) {
            return true;
        }
        if (Request::is('admin/categories')) {
            return true;
        }

        return false;
    }


    /**
     * @return bool
     */
    public static function checkCustomers(): bool
    {
        if (Request::is('admin/customers/*')) {
            return true;
        }
        if (Request::is('admin/customers')) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public static function checkMerchants(): bool
    {
        if (Request::is('admin/merchants/*')) {
            return true;
        }
        if (Request::is('admin/merchants')) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public static function checkCategories(): bool
    {
        if (Request::is('admin/categories/*')) {
            return true;
        }
        if (Request::is('admin/categories')) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public static function checkReview(): bool
    {
        if (Request::is('admin/review/*')) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public static function checkProductReview(): bool
    {
        if (Request::is('admin/review/product/*')) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public static function checkMerchantReview(): bool
    {
        if (Request::is('admin/review/merchant/*')) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public static function checkPayments(): bool
    {
        if (Request::is('admin/payments/income')) {
            return true;
        }
        if (Request::is('admin/payments/income/*')) {
            return true;
        }

        if (Request::is('admin/payments/outcome')) {
            return true;
        }
        if (Request::is('admin/payments/outcome/*')) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public static function checkIncome(): bool
    {
        if (Request::is('admin/payments/income')) {
            return true;
        }
        if (Request::is('admin/payments/income/*')) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public static function checkOutcome(): bool
    {
        if (Request::is('admin/payments/outcome')) {
            return true;
        }
        if (Request::is('admin/payments/outcome/*')) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public static function checkAdvert(): bool
    {
        if (Request::is('admin/adverts')) {
            return true;
        }
        if (Request::is('admin/adverts/*')) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public static function checkLogs(): bool
    {
        if (Request::is('admin/logs')) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public static function checkCsv(): bool
    {
        if (Request::is('admin/csv')) {
            return true;
        }

        return false;
    }
}
