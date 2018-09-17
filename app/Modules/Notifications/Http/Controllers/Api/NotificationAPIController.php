<?php

namespace App\Modules\Notifications\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Notifications\Models\Notification;
use App\Modules\Notifications\Repositories\NotificationRepository;
use App\Modules\Notifications\Requests\GetNotificationsRequest;
use App\Modules\Users\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class NotificationAPIController extends Controller
{
    /** @var NotificationRepository $notificationRepository */
    protected $notificationRepository;

    /**
     * NotificationAPIController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->notificationRepository = app(NotificationRepository::class);
    }

    /**
     * @param GetNotificationsRequest $request
     *
     * @return JsonResponse
     */
    public function index(GetNotificationsRequest $request): JsonResponse
    {
        $offset = $request->get('offset', 0);
        /** @var User $user */
        $user = Auth::user();
        $notification = app(Notification::class);
        $notifications = $notification->markReadAndGet($user->id, $offset);

        return response()->json([
            'notifications' => $notifications,
        ]);
    }

    /**
     * @param string $id
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(string $id): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();
        /** @var Notification $notification */
        $notification = $this->notificationRepository->findWithoutFail($id);
        if (null === $notification) {
            abort(400, 'No such notification');
        }
        if (!$user->owns($notification)) {
            abort(403, 'You can delete only your own notifications');
        }

        $notification->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
