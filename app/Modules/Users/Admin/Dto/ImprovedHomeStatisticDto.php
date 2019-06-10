<?php
/**
 * Created by Maksym Igntachenko, Appus Studio LP on 10.06.2019
 */

namespace App\Modules\Users\Admin\Dto;

class ImprovedHomeStatisticDto extends HomeStatisticDto
{
    /**
     * @var int
     */
    protected $ordersCount;

    /**
     * @param int $value
     * @return ImprovedHomeStatisticDto
     */
    public function setOrdersCount(int $value) : self
    {
        $this->ordersCount = $value;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrdersCount() : int
    {
        return $this->ordersCount;
    }
}
