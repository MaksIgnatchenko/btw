<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 15.02.2019
 */

namespace App\Modules\Reviews\Repositories;

use App\Modules\Orders\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Interface ReviewRepositoryInterface
 * @package App\Modules\Reviews\Repositories
 */
interface ReviewRepositoryInterface
{
    /**
     * @param int $ownerId
     * @param int $offset
     * @return Collection|null
     */
    public function getActiveReviewsByOwnerId(int $ownerId, int $offset) : ?Collection;

    /**
     * @param int $ownerId
     * @param int $offset
     * @return Collection|null
     */
    public function getActiveReviewsByOwnerIdPaginated(int $ownerId) : ?LengthAwarePaginator;

    /**
     * @param int $ownerId
     * @param int $offset
     * @return Collection|null
     */
    public function getInactiveReviewsByOwnerId(int $ownerId, int $offset) : ?Collection;

    /**
     * @param Order $order
     * @param int $rating
     * @param string $comment
     * @return mixed
     */
    public function createReview(Order $order, int $rating, string $comment);

    /**
     * @param int $id
     * @return mixed
     */
    public function getReview(int $id);
}
