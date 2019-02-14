<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 14.02.2019
 */

namespace App\Modules\Reviews\Dto;


use App\Modules\Orders\Models\Order;

class ReviewDto
{
    /**
     * @var Order
     */
    protected $order;
    /**
     * @var int
     */
    protected $rating;
    /**
     * @var string
     */
    protected $comment;

    /**
     * ReviewDto constructor.
     * @param Order $order
     * @param int $rating
     * @param string $comment
     */
    public function __construct(Order $order, int $rating, string $comment)
    {
        $this->order = $order;
        $this->rating = $rating;
        $this->comment = $comment;
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

    /**
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }
}