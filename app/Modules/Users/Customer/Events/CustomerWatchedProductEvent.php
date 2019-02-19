<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 19.02.2019
 */

namespace App\Modules\Users\Customer\Events;

use App\Modules\Products\Models\Product;
use App\Modules\Users\Customer\Models\Customer;

/**
 * Class CustomerWatchedProductEvent
 * @package App\Modules\Users\Customer\Events
 */
class CustomerWatchedProductEvent
{
    /**
     * @var Customer
     */
    protected $customer;
    /**
     * @var Product
     */
    protected $product;


    /**
     * CustomerWatchedProduct constructor.
     * @param $customer
     * @param $product
     * @param $timestamp
     */
    public function __construct(Customer $customer, Product $product)
    {
        $this->customer = $customer;
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     */
    public function setCustomer($customer): void
    {
        $this->customer = $customer;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product): void
    {
        $this->product = $product;
    }
}
