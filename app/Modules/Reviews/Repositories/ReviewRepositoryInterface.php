<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 15.02.2019
 */

namespace App\Modules\Reviews\Repositories;

use App\Modules\Orders\Models\Order;
use Illuminate\Support\Collection;

interface ReviewRepositoryInterface
{
    public function getActiveReviews(int $ownerId, int $offset) : ?Collection;

    public function getInactiveReviews(int $ownerId, int $offset) : ?Collection;

    public function createReview(Order $order, int $rating, string $comment);
}
