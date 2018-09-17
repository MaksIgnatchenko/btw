<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 14.12.2017
 */

namespace App\Modules\Products\Events;

use App\Modules\Products\Models\Product;
use Illuminate\Queue\SerializesModels;

class AddProductEvent
{
    use SerializesModels;

    /** @var Product */
    protected $product;

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     *
     * @return AddProductEvent
     */
    public function setProduct(Product $product): AddProductEvent
    {
        $this->product = $product;

        return $this;
    }
}
