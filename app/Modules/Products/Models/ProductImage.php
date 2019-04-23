<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 01.12.2017
 */

namespace App\Modules\Products\Models;

use App\Modules\Products\Repositories\ProductImageRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductImage extends Model
{
    protected $imageManager;

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

    public function __construct(array $attributes = [])
    {
        $this->imageManager = app()[ImageManager::class];

        parent::__construct($attributes);
    }

    /**
     * Create image thumbnail.
     *
     * @param UploadedFile $image
     * @return Image
     */
    public function createImageThumbnail(UploadedFile $image): Image
    {
        $thumbnail = $this->imageManager->make($image->path())->orientate();

        $thumbnail->resize(
            config('wish.storage.products.image_thumb_width'),
            config('wish.storage.products.image_thumb_height'),
            function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            }
        )->encode();

        return $thumbnail;
    }

    /**
     * Save product gallery images. (original and thumbnails)
     *
     * @param array $images
     * @param int $productId
     * @param int $storeId
     */
    public function saveGalleryImages(array $images, int $productId, int $storeId): void
    {
        $productImageRepository = app()[ProductImageRepository::class];

        foreach ($images as $image) {
            $imageName = $image->hashName();
            $imageThumbnail = $this->createImageThumbnail($image);
            $this->saveImageWithThumbnail(
                config('wish.storage.products.gallery_images_path'),
                config('wish.storage.products.gallery_images_thumb_path'),
                $imageName,
                $imageThumbnail,
                $storeId,
                $image
            );

            $imagePath = $storeId . '/' . $imageName;
            $productImageData = [
                'image'      => $imagePath,
                'product_id' => $productId,
            ];

            $productImageRepository->create($productImageData);
        }
    }

    /**
     * @param string $originalPath
     * @param string $thumbnailPath
     * @param string $imageName
     * @param Image $thumbnail
     * @param int $storeId
     * @param UploadedFile $image
     */
    public function saveImageWithThumbnail(string $originalPath, string $thumbnailPath, string $imageName, Image $thumbnail, int $storeId, UploadedFile $image): void
    {
        $image = $this->imageManager->make($image)->orientate()->encode();

        Storage::disk('public')->put($originalPath . '/' . $storeId .'/' . $imageName, $image);
        Storage::disk('public')->put($thumbnailPath . '/' . $storeId . '/' . $imageName, $thumbnail);
    }

    /**
     * Product image accessor.
     *
     * @param string $attribute
     * @return string
     */
    public function getImageAttribute(string $attribute): string
    {
        return asset(Storage::url(config('wish.storage.products.gallery_images_path') . '/' . $attribute));
    }
}
