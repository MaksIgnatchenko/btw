<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 04.12.2017
 */

namespace App\Modules\Products\Repositories;

use App\Modules\Products\Models\ProductImage;
use InfyOm\Generator\Common\BaseRepository;

class ProductImageRepository extends BaseRepository
{
    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return ProductImage::class;
    }

    /**
     * @param ProductImage $productImage
     */
    public function save(ProductImage $productImage): void
    {
        $productImage->save();
    }

    /**
     * @param int $productId
     */
    public function deleteByProductId(int $productId): void
    {
        $this->deleteWhere(['product_id' => $productId]);
    }
}
