<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 26.01.2018
 */

namespace App\Modules\Advert\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Advert\Repositories\AdvertConfigRepository;
use App\Modules\Advert\Requests\Admin\UpdateAdvertModeRequest;
use Laracasts\Flash\Flash;

class AdvertConfigController extends Controller
{

    /**
     * @param string $key
     * @param UpdateAdvertModeRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(string $key, UpdateAdvertModeRequest $request)
    {
        /** @var AdvertConfigRepository $advertConfigRepository */
        $advertConfigRepository = app(AdvertConfigRepository::class);
        $value = $request->get('value');

        $advertConfigRepository->update(['value' => $value], $key);

        Flash::success('Banner mode updated successfully');

        return redirect(route('adverts.index'));
    }
}
