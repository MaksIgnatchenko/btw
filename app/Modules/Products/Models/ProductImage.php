<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 01.12.2017
 */

namespace App\Modules\Products\Models;

use App\Modules\Products\Repositories\ProductImageRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductImage extends Model
{
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
     * Create image thumbnail.
     *
     * @param UploadedFile $image
     * @return Image
     */
    public function createImageThumbnail(UploadedFile $image): Image
    {
        $imageManager = app()[ImageManager::class];
        $thumbnail = $imageManager->make($image->path());

        $thumbnail->resize(
            config('wish.products.storage.image_thumb_width'),
            config('wish.products.storage.image_thumb_height'),
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
     */
    public function saveImages(array $images, int $productId): void
    {
        $productImageRepository = app(ProductImageRepository::class);
        $storeId = Auth::user()->store->id;

        foreach ($images as $image) {
            $imageName = $image->hashName();
            $imageThumbnail = $this->createImageThumbnail($image);

            Storage::putFileAs(config('wish.products.storage.gallery_images_path') . '/' . $storeId, $image, $imageName);
            Storage::disk('public')->put(config('wish.products.storage.gallery_images_thumb_path') . '/' . $storeId . '/' . $imageName, $imageThumbnail);

            $imagePath = $storeId . '/' . $imageName;
            $productImageData = [
                'image'      => $imagePath,
                'product_id' => $productId,
            ];

            $productImageRepository->create($productImageData);
        }
    }
}
