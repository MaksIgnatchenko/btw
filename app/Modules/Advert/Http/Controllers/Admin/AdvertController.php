<?php

namespace App\Modules\Advert\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Advert\DataTables\AdvertDataTable;
use App\Modules\Advert\Models\Advert;
use App\Modules\Advert\Models\AdvertConfig;
use App\Modules\Advert\Repositories\AdvertConfigRepository;
use App\Modules\Advert\Requests\Admin\CreateAdvertRequest;
use App\Modules\Advert\Requests\Admin\UpdateAdvertRequest;
use App\Modules\Advert\Repositories\AdvertRepository;
use Laracasts\Flash\Flash;

class AdvertController extends Controller
{
    /**
     * Display a listing of the Advert.
     *
     * @param AdvertDataTable $advertDataTable
     *
     * @return Response
     */
    public function index(AdvertDataTable $advertDataTable)
    {
        /** @var AdvertConfigRepository $advertConfigRepository */
        $advertConfigRepository = app(AdvertConfigRepository::class);
        $advertConfig = $advertConfigRepository->find(AdvertConfig::MODE);

        return $advertDataTable->render('adverts.index', ['advertConfig' => $advertConfig]);
    }

    /**
     * Show the form for creating a new Advert.
     *
     * @return Response
     */
    public function create()
    {
        return view('adverts.create');
    }

    /**
     * Store a newly created Advert in storage.
     *
     * @param CreateAdvertRequest $request
     *
     * @return Response
     */
    public function store(CreateAdvertRequest $request)
    {
        $input = $request->all();

        /** @var Advert $advert */
        $advert = app(Advert::class);
        $advert->create($input);

        Flash::success('Banner saved successfully.');

        return redirect(route('adverts.index'));
    }

    /**
     * Show the form for editing the specified Advert.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit(int $id)
    {
        /** @var AdvertRepository $advertRepository */
        $advertRepository = app(AdvertRepository::class);
        $advert = $advertRepository->findWithoutFail($id);

        if (null === $advert) {
            Flash::error('Banner not found');

            return redirect(route('adverts.index'));
        }

        return view('adverts.edit')->with('advert', $advert);
    }

    /**
     * Update the specified Advert in storage.
     *
     * @param  int $id
     * @param UpdateAdvertRequest $request
     *
     * @return Response
     */
    public function update(int $id, UpdateAdvertRequest $request)
    {
        /** @var AdvertRepository $advertRepository */
        $advertRepository = app(AdvertRepository::class);
        $advert = $advertRepository->findWithoutFail($id);

        if (null === $advert) {
            Flash::error('Banner not found');

            return redirect(route('adverts.index'));
        }

        $advertRepository->update($request->all(), $id);

        Flash::success('Banner updated successfully.');

        return redirect(route('adverts.index'));
    }
}
