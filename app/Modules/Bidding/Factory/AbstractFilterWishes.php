<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 31.01.2018
 */


namespace App\Modules\Bidding\Factories;


use App\Modules\Bidding\Repositories\WishRepository;

abstract class AbstractFilterWishes
{
    /** @var WishRepository $wishRepository */
    protected $wishRepository;

    /**
     * FilterMerchantAbstract constructor.
     */
    public function __construct()
    {
        $this->wishRepository = app(WishRepository::class);
    }
}