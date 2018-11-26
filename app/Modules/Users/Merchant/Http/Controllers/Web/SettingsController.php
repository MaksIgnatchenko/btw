<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 8.11.2018
 */

namespace App\Modules\Users\Merchant\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\Users\Merchant\Helpers\SettingsControllerHelper;
use App\Modules\Users\Merchant\Models\Merchant;
use App\Modules\Users\Merchant\Repositories\MerchantRepository;
use App\Modules\Users\Merchant\Requests\UpdateAccountSettingsRequest;
use App\Modules\Users\Merchant\Requests\UpdateAvatarRequest;
use App\Modules\Users\Merchant\Requests\UpdateBackgroundImage;
use App\Modules\Users\Merchant\Requests\UpdateStoreSettingsRequest;
use App\Modules\Users\Merchant\Services\Geography\GeographyServiceInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /** @var GeographyServiceInterface */
    protected $geographyService;

    /** @var MerchantRepository */
    protected $merchantRepository;

    /**
     * SettingsController constructor.
     *
     * @param GeographyServiceInterface $geographyService
     */
    public function __construct(GeographyServiceInterface $geographyService, MerchantRepository $merchantRepository)
    {
        $this->geographyService = $geographyService;
        $this->merchantRepository = $merchantRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        /** @var Merchant $merchant */
        $merchant = Auth::user();

        return view('merchants.web.settings', [
            'merchant' => $merchant,
            'merchantSettingsDto' => SettingsControllerHelper::getMerchantSettingsData($merchant),
        ]);
    }

    /**
     * @param UpdateAccountSettingsRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAccountSettings(UpdateAccountSettingsRequest $request)
    {
        /** @var Merchant $merchant */
        $merchant = Auth::user();
        $merchant->updateAccountInfo($request->all());

        return back();
    }

    /**
     * @param UpdateStoreSettingsRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStoreSettings(UpdateStoreSettingsRequest $request)
    {
        /** @var Merchant $merchant */
        $merchant = Auth::user();

        $merchant->store->updateStoreInfo(array_merge($request->all(), [
            'country' => $request->store_country,
            'city' => $request->store_city,
        ]));

        return back();
    }

    /**
     * @param UpdateAvatarRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function updateAvatar(UpdateAvatarRequest $request)
    {
        return response()->json([
            'avatar_url' => $this->uploadImage(
                $request->file('avatar'),
                config('wish.storage.merchants.avatar_path'),
                'avatar'),
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAvatar()
    {
        $this->removeImage('avatar');

        return response()->json([
            'default_avatar_url' => config('wish.storage.merchants.default_avatar_url'),
        ]);
    }

    /**
     * @param UpdateBackgroundImage $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function updateBackgroundImg(UpdateBackgroundImage $request)
    {
        return response()->json([
            'background_img_url' => $this->uploadImage(
                $request->file('background_image'),
                config('wish.storage.merchants.background_path'),
                'background_img'),
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteBackgroundImg()
    {
        return response()->json([
            'success' => $this->removeImage('background_image'),
        ]);
    }

    /**
     * @param UploadedFile $img
     * @param string       $path
     * @param string       $fieldName
     *
     * @return string
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    protected function uploadImage(UploadedFile $img, string $path, string $fieldName): string
    {
        $imgUrl = $img->store($path);

        /** @var Merchant $merchant */
        $merchant = Auth::user();

        $this->merchantRepository->update([
            $fieldName => $img->hashName(),
        ], $merchant->id);

        return $imgUrl;
    }

    /**
     * @param string $fieldName
     *
     * @return bool
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    protected function removeImage(string $fieldName): bool
    {
        /** @var Merchant $merchant */
        $merchant = Auth::user();

        $imgUrl = str_replace(Storage::url(''), null, $merchant->$fieldName);

        $this->merchantRepository->update([
            $fieldName => null,
        ], $merchant->id);

        return Storage::delete($imgUrl);
    }
}
