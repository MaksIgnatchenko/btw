<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 15.02.2018
 */

namespace App\Modules\Bidding\Events;

use App\Modules\Bidding\Models\Wish;

class AddToWishListEvent
{
    /** @var Wish */
    protected $wish;

    /**
     * AddToWishListEvent constructor.
     *
     * @param Wish $wish
     */
    public function __construct(Wish $wish)
    {
        $this->wish = $wish;
    }

    /**
     * @return Wish
     */
    public function getWish(): Wish
    {
        return $this->wish;
    }
}
