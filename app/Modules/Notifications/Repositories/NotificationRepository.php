<?php

namespace App\Modules\Notifications\Repositories;

use App\Modules\Notifications\Models\Notification;
use Illuminate\Support\Collection;
use InfyOm\Generator\Common\BaseRepository;

class NotificationRepository extends BaseRepository
{
    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return Notification::class;
    }

    /**
     * @param Notification $advert
     */
    public function save(Notification $advert): void
    {
        $advert->save();
    }

    /**
     * @param int $userId
     */
    public function markReadAll(int $userId): void
    {
        Notification::where('user_id', $userId)
            ->update(['is_read' => true]);
    }

    /**
     * @param int $userId
     * @param int $offset
     * @param int $limit
     *
     * @return Collection
     */
    public function findByUserId(int $userId, int $offset, int $limit): Collection
    {
        return Notification::where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->offset($offset)
            ->limit($limit)
            ->get();
    }
}
