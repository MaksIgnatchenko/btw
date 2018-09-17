<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 26.12.2017
 */

namespace App\Modules\Products\Helpers;

use App\Modules\Advert\Models\Advert;
use App\Modules\Products\Models\ProductImage;

// TODO move helper to global
class ImagesPathHelper
{
    /**
     * @param string $imageName
     *
     * @return string
     */
    public static function getProductImagePath(string $imageName): string
    {
        return url(ProductImage::IMAGE_URL . $imageName);
    }

    /**
     * @param string $imageName
     *
     * @return string
     */
    public static function getProductThumbPath(string $imageName): string
    {
        return url(ProductImage::THUMB_URL . $imageName);
    }

    /**
     * @param string $imageName
     *
     * @return string
     */
    public static function getAdvertImagePath(string $imageName): string
    {
        return url(Advert::IMAGE_URL . $imageName);
    }
}
