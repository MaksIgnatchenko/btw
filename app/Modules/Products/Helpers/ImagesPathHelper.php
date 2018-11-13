<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 26.12.2017
 */

namespace App\Modules\Products\Helpers;

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
        return url(config('wish.products.storage.main_images_path') . $imageName);
    }

    /**
     * @param string $imageName
     *
     * @return string
     */
    public static function getProductThumbPath(string $imageName): string
    {
        return url(config('wish.storage.products.main_images_thumb_path') . $imageName);
    }

    /**
     * @param string $imageName
     *
     * @return string
     */
    public static function getAdvertImagePath(string $imageName): string
    {
        return url(config('wish.storage.products.gallery_images_path') . $imageName);
    }
}
