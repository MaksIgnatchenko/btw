<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 19.10.2018
 */

namespace App\Modules\Store\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class StoreController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('store.store');
    }
}
