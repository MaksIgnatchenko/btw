<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 28.11.2017
 */

namespace App\Modules\Users\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Users\Repositories\UserSettingsRepository;
use App\Modules\Users\Requests\Api\SetSettingRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserSettingsController extends Controller
{
    /** @var UserSettingsRepository */
    protected $userSettingsRepository;

    /**
     * UserSettingsController constructor.
     *
     * @param UserSettingsRepository $userSettingsRepository
     */
    public function __construct(UserSettingsRepository $userSettingsRepository)
    {
        $this->middleware('auth:api');

        $this->userSettingsRepository = $userSettingsRepository;
    }

    /**
     * @param SetSettingRequest $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function set(SetSettingRequest $request)
    {
        $userId = Auth::user()->id;

        $userSettingsModel = $this->userSettingsRepository->findByUserId($userId);
        $userSettingsModel->setSetting($request->get('setting'), $request->get('value'));
        $this->userSettingsRepository->save($userSettingsModel);

        return response()->json(['success' => true]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(): JsonResponse
    {
        $userId = Auth::user()->id;

        $userSettingsModel = $this->userSettingsRepository->firstOrCreate([
            'user_id' => $userId,
        ]);

        $response = [
            'settings' => empty($userSettingsModel->settings) ? '{}' : $userSettingsModel->settings
        ];

        return response()->json($response);
    }
}
