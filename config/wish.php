<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 06.11.2018
 */

return [
    'products' => [
        'storage' => [
            'main_images_path' => env('MAIN_PRODUCT_IMAGES_ORIGIN_PATH', 'images/products/main_images/original'),
            'gallery_images_path' => env('GALLERY_PRODUCT_IMAGES_ORIGIN_PATH', 'images/products/gallery/original'),
            'main_images_thumb_path' => env('MAIN_PRODUCT_IMAGES_THUMB_PATH', 'images/products/main_images/thumbs'),
            'gallery_images_thumb_path' => env('GALLERY_PRODUCT_IMAGES_THUMB_PATH', 'images/products/gallery/thumbs'),
            'image_thumb_width' => env('PRODUCT_IMAGE_THUMB_WIDTH', 960),
            'image_thumb_height' => env('PRODUCT_IMAGE_THUMB_HEIGHT', 640),
            'image_max_size' => env('PRODUCT_IMAGE_MAX_SIZE', 1024 * 1024 * 5),
        ]
    ],
    'merchants' => [],
];
