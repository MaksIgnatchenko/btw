<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 01.12.2017
 */

namespace App\Modules\Products\Models;

use App\Modules\Products\Repositories\ProductImageRepository;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductImage extends Model
{
    public const IMAGE_MAX_SIZE = 1024 * 1024 * 5;
    public const IMAGE_MAX_DIMENSION = 2436;

    protected const IMAGE_THUMB_WIDTH = 320;
    protected const IMAGE_THUMB_HEIGHT = 240;

    public const IMAGES_STORE_PATH = 'public/images/products/origin';
    public const IMAGES_STORE_THUMBS_PATH = 'app/public/images/products/thumbs/';

    public const IMAGES_PATH = 'app/public/images/products/origin/';
    public const IMAGES_THUMBS_PATH = 'app/public/images/products/thumbs/';

    public const IMAGE_URL = 'storage/images/products/origin/';
    public const THUMB_URL = 'storage/images/products/thumbs/';

    public const IMAGES_MAX_COUNT = 5;

    /** @var array */
    public $fillable = [
        'product_id',
        'image',
    ];

    /** @var array */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'image'      => 'string',
        'product_id' => 'integer',

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'image'      => 'required|string',
        'product_id' => 'required|exists:products,id',
    ];

    /**
     * @param array $images
     * @param int $productId
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function saveImages(array $images, int $productId): void
    {
        /** @var ProductImageRepository $productImageRepository */
        $productImageRepository = app(ProductImageRepository::class);

        foreach ($images as $image) {
            $image->store(self::IMAGES_STORE_PATH);

            $thumb = $this->getMainImageThumb($image);
            $thumb->save(storage_path(self::IMAGES_STORE_THUMBS_PATH . $image->hashName()));

            /** @var $productImageModel ProductImage */
            $productImage = new self();
            $productImage->fill([
                'image'      => $image->hashName(),
                'product_id' => $productId,
            ]);
            // sorry for this :(
            $productImageRepository->save($productImage);
        }
    }

    /**
     * @param UploadedFile $mainImage
     *
     * @return \Intervention\Image\Image
     */
    public function getMainImageThumb(UploadedFile $mainImage): Image
    {
        $manager = app()[ImageManager::class];

        $thumb = $manager->make($mainImage->path());
        $thumb->resize(self::IMAGE_THUMB_WIDTH, self::IMAGE_THUMB_HEIGHT, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        return $thumb;
    }
}
