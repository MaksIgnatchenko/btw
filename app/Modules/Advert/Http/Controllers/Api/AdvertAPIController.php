<?php

namespace App\Modules\Advert\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Advert\Models\Advert;
use App\Modules\Advert\Models\AdvertConfig;
use Illuminate\Http\JsonResponse;

class AdvertAPIController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \InvalidArgumentException
     */
    public function index(): JsonResponse
    {
        /** @var AdvertConfig $advertConfigModel */
        $advertConfigModel = app(AdvertConfig::class);
        $mode = $advertConfigModel->getMode();

        /** @var Advert $advertModel */
        $advertModel = app(Advert::class);
        $advert = $advertModel->get($mode);
        if (null === $advert && AdvertConfig::CUSTOM_MODE === $mode) {
            abort(400, 'There is no active banners!');
        }
        if (null !== $advert) {
            $advert->incrementCounter();
        }

        return response()->json([
            'advert' => $advert,
            'mode'   => $mode,
        ]);
    }
}
