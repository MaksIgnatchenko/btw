<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 08.02.2018
 */

namespace App\Modules\WebOffers\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Advert\DataTables\LogDataTable;

class LogController extends Controller
{
    /**
     * Display a listing of the Advert.
     *
     * @param LogDataTable $logDataTable
     *
     * @return Response
     */
    public function index(LogDataTable $logDataTable)
    {
        return $logDataTable->render('logs.index');
    }
}
