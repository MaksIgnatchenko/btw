<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 12.04.2019
 */

namespace App\Modules\Orders\Events;


use App\Modules\Orders\Models\Order;
use Illuminate\Queue\SerializesModels;

/**
 * Class OrderClosedEvent
 * @package App\Modules\Orders\Events
 */
class OrderClosedEvent
{
    use SerializesModels;

    /**
     * @var Order
     */
    protected $order;

    /**
     * OrderClosedEvent constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @param Order $order
     */
    public function setOrder(Order $order): void
    {
        $this->order = $order;
    }


}