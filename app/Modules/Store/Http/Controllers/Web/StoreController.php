<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 19.10.2018
 */

namespace App\Modules\Store\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    public function index()
    {
        return view('store.index');
    }
}
