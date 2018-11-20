<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 06.11.2018
 */

return [
    'storage' => [
        'products' => [
            'main_images_path' => env('MAIN_PRODUCT_IMAGES_ORIGIN_PATH', 'images/products/main_images/original'),
            'gallery_images_path' => env('GALLERY_PRODUCT_IMAGES_ORIGIN_PATH', 'images/products/gallery/original'),
            'main_images_thumb_path' => env('MAIN_PRODUCT_IMAGES_THUMB_PATH', 'images/products/main_images/thumbs'),
            'gallery_images_thumb_path' => env('GALLERY_PRODUCT_IMAGES_THUMB_PATH', 'images/products/gallery/thumbs'),
            'image_thumb_width' => env('PRODUCT_IMAGE_THUMB_WIDTH', 960),
            'image_thumb_height' => env('PRODUCT_IMAGE_THUMB_HEIGHT', 640),
            'image_max_size' => env('PRODUCT_IMAGE_MAX_SIZE', 1024 * 1024 * 5),
            'image_mimes' => env('PRODUCT_IMAGE_MIMES', 'jpeg,jpg,png'),
        ],
        'customers' => [
            'avatar_path' => env('CUSTOMER_AVATAR_PATH', 'customers/avatars'),
        ],
        'merchants' => [
            'avatar_path' => env('MERCHANT_AVATAR_PATH', 'merchants/avatars'),
            'background_path' => env('MERCHANT_BACKGROUND_PATH', 'merchants/backgrounds'),
            'default_avatar_url' => env('MERCHANT_DEFAULT_AVATAR_URL', '/img/user-icon-color.svg'),
        ],
    ],
    'store' => [
        'pagination' => env('PRODUCTS_PAGINATION', 12),
    ]
];
