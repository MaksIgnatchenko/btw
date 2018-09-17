<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 05.01.2018
 */

namespace App\Modules\Products\Repositories;

use App\Modules\Products\Models\ProductLocalDelivery;
use InfyOm\Generator\Common\BaseRepository;

class ProductLocalDeliveryRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return ProductLocalDelivery::class;
    }

    /**
     * @param ProductLocalDelivery $model
     */
    public function save(ProductLocalDelivery $model): void
    {
        $model->save();
    }
}
