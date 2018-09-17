<?php

namespace App\Modules\Notifications\Models;

use App\Modules\Notifications\Repositories\NotificationRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public const PAGE_LIMIT = 50;

    public $fillable = [
        'title',
        'message',
        'user_id',
        'is_read',
    ];

    protected $visible = [
        'id',
        'title',
        'message',
        'is_read',
        'created_at',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title'   => 'string',
        'message' => 'string',
        'user_id' => 'integer',
        'is_read' => 'boolean',
    ];

    /**
     * @param int $userId
     *
     * @return Collection
     */
    public function markReadAndGet(int $userId, int $offset): Collection
    {
        /** @var NotificationRepository $notificationRepository */
        $notificationRepository = app(NotificationRepository::class);

        $notifications = $notificationRepository->findByUserId($userId, $offset, self::PAGE_LIMIT);
        $notificationRepository->markReadAll($userId);

        return $notifications;
    }
}
